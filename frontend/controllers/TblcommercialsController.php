<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Tblcommercials;
use frontend\models\TblcommercialsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
/**
 * TblcommercialsController implements the CRUD actions for Tblcommercials model.
 */
class TblcommercialsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','update','view','index'],
                'rules' => [
                    [
                        'actions' => ['create','update','view','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tblcommercials models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblcommercialsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['updated_at'=>SORT_DESC])->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tblcommercials model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tblcommercials model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tblcommercials();
        $mt = explode(' ', microtime());
        $new = ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
        if ($model->load(Yii::$app->request->post())) {
            $file= UploadedFile::getInstance($model,'url');
            if($file){
                $filename = 'commercials_file_'.$new;
                $model->url =  $file;
                $model->url->saveAs('uploads/'.$filename.'.'.$model->url->extension);
                $model->url = $filename.'.'.$model->url->extension;
            }else{
                $model->url ='';
            }   
            $filename =  $model->url;
            $getID3 = new \getID3;
            $file = $getID3->analyze(\Yii::getAlias('@webroot').'/uploads/'.$filename);
            $model->duration = $file['playtime_string'];
            $model->created_at = time();
            $model->updated_at = time();
            $model->save();
            return $this->redirect(['view', 'id' => $model->ad_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tblcommercials model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldfile = $model->url;
        $mt = explode(' ', microtime());
        $new = ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));

        if ($model->load(Yii::$app->request->post()) ) {
            $fileprev = 'uploads/'.$oldfile;
            $filename = 'commercials_file_'.$new;
            $model->url = UploadedFile::getInstance($model,'url');

            if(!empty($model->url)){
                if($oldfile==""){
                    $model->url->saveAs('uploads/'.$filename.'.'.$model->url->extension);
                    $model->url=$filename.'.'.$model->url->extension;
                }else if(!file_exists($fileprev)){
                    $model->url->saveAs('uploads/'.$filename.'.'.$model->url->extension);
                    $model->url=$filename.'.'.$model->url->extension;
                }else{
                    unlink('uploads/'.$oldfile);
                    $model->url->saveAs('uploads/'.$filename.'.'.$model->url->extension);
                    $model->url=$filename.'.'.$model->url->extension;
                }
            }else{
                $model->url = $oldfile;
            }   
            $filename =  $model->url;
            $getID3 = new \getID3;
            $file = $getID3->analyze(\Yii::getAlias('@webroot').'/uploads/'.$filename);
            $model->duration = $file['playtime_string'];
            $model->updated_at = time();
            $model->save();
            return $this->redirect(['view', 'id' => $model->ad_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tblcommercials model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tblcommercials model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tblcommercials the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tblcommercials::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
