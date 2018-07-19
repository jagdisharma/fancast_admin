<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Tblchannels;
use frontend\models\Tblchanneltags;
use frontend\models\TblchannelsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use frontend\models\Tblusers;
use yii\helpers\ArrayHelper;
use frontend\models\Tbltags;
/**
 * TblchannelsController implements the CRUD actions for Tblchannels model.
 */
class TblchannelsController extends Controller
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
     * Lists all Tblchannels models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblchannelsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['updated_at'=>SORT_DESC])->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tblchannels model.
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
     * Creates a new Tblchannels model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tblchannels();
        $modelusers = new Tblusers();
        $modeltags = new Tbltags();
        

        $mt = explode(' ', microtime());
        $new = ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));

        $users = Tblusers::find()->all();
        $schedulesArray = ArrayHelper::map($users,'user_id', function ($users, $defaultValue) {
            return $users->username. ' - ' .$users->email;
        });

        if ($model->load(Yii::$app->request->post())) {
            $request = Yii::$app->request->post();
            $file= UploadedFile::getInstance($model,'image');
            if($file){
                $imagename = 'channels_Picture_'.$model->user_id.'_'.$new;
                $model->image =  $file;
                $model->image->saveAs('uploads/'.$imagename.'.'.$model->image->extension);
                $model->image = $imagename.'.'.$model->image->extension;
            }else{
                $model->image ='';
            }
            $newtime = strtotime($model->time);
            $model->time= $newtime;
            $model->created_at = $new;
            $model->updated_at = $new;
            $model->save();
            $channel_id = $model['channel_id'];
            if(isset($request['Tbltags']) && !empty($request['Tbltags'])){
                $tagId = $request['Tbltags']['tag_id'];
                foreach($tagId as $tag){
                    $modelChanneltags = new Tblchanneltags();
                    $modelChanneltags->channel_id = $channel_id;
                    $modelChanneltags->tag_id = $tag;  
                    $modelChanneltags->created_at = time();
                    $modelChanneltags->updated_at = time();    
                    $modelChanneltags->save();        
                }
            }
            return $this->redirect(['view', 'id' => $model->channel_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelusers' => $modelusers,
            'schedulesArray' => $schedulesArray,
            'modeltags' => $modeltags,
        ]);
    }

    /**
     * Updates an existing Tblchannels model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelusers = new Tblusers();
        $old_tags = array();
        $modelChanneltags = Tblchanneltags::find()->where(['channel_id' => $id])->all();
        
       if(!empty($modelChanneltags)) {
            foreach ($modelChanneltags as $modelChanneltag) {
                $tag[]=$modelChanneltag->tag_id;
            }
            $modeltagsData= Tbltags::find()->where(['tag_id' => $tag])->all();
            if(!empty($modeltagsData)) {
                $modeltags = new Tbltags();
                $seletedTags = array();
                foreach($modeltagsData as $t) {
                    $seletedTags[] = $t->tag_id;
                }
                $old_tags = $seletedTags;
                $modeltags->tag_id = $seletedTags;
            } else {
                $modelChanneltags = new Tbltags;    
            }
        }else{
            $modeltags = new Tbltags();
        }

        $oldfile = $model->image;
        $mt = explode(' ', microtime());
        $new = ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
        $users = Tblusers::find()->all();
        $schedulesArray = ArrayHelper::map($users,'user_id', function ($users, $defaultValue) {
            return $users->username. ' - ' .$users->email;
        });
        if ($model->load(Yii::$app->request->post()) ) {
            $request = Yii::$app->request->post();
            $fileprev = 'uploads/'.$oldfile;
            $imagename = 'channels_Picture_'.$model->user_id.'_'.$new;
            $model->image = UploadedFile::getInstance($model,'image');

            if(!empty($model->image)) {
                if($oldfile==""){
                    $model->image->saveAs('uploads/'.$imagename.'.'.$model->image->extension);
                    $model->image=$imagename.'.'.$model->image->extension;
                }else if(!file_exists($fileprev)){
                    $model->image->saveAs('uploads/'.$imagename.'.'.$model->image->extension);
                    $model->image=$imagename.'.'.$model->image->extension;
                }else{
                    unlink('uploads/'.$oldfile);
                    $model->image->saveAs('uploads/'.$imagename.'.'.$model->image->extension);
                    $model->image=$imagename.'.'.$model->image->extension;
                }
            }else{
                $model->image = $oldfile;
            }
            $model->time = strtotime($model->time);
            $model->updated_at = time();
            $model->save();

            $channel_id = $model['channel_id'];
            $newTags = $request['Tbltags']['tag_id'];

            if(!empty($newTags)) {
                foreach($newTags as $tagSelect) {
                    // if new tag selected add to database
                    if(!in_array($tagSelect,$old_tags)){
                        // save tag to database with respect to channel id
                        $modelChanneltags = new Tblchanneltags();
                        $modelChanneltags->channel_id = $channel_id;
                        $modelChanneltags->tag_id = $tagSelect;  
                        $modelChanneltags->created_at = time();
                        $modelChanneltags->updated_at = time();    
                        $modelChanneltags->save();  
                    }
                } 
            } else {
                // delete all if no tags selected 
                foreach($old_tags as $otag) {
                    // remove it from database w.r.t channel id
                    \Yii::$app
                    ->db
                    ->createCommand()
                    ->delete('TBL_CHANNEL_TAGS', ['channel_id'=>$channel_id,'tag_id'=>$otag])
                    ->execute(); 
                }
            }
            // remove old tags from database
            if(!empty($old_tags) && !empty($newTags)) {
                foreach($old_tags as $otag) {
                    if(!in_array($otag, $newTags)){
                        // remove it from database w.r.t channel id
                        \Yii::$app
                        ->db
                        ->createCommand()
                        ->delete('TBL_CHANNEL_TAGS', ['channel_id'=>$channel_id,'tag_id'=>$otag])
                        ->execute();
                    }
                }      
            }
            return $this->redirect(['view', 'id' => $model->channel_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'modelusers' => $modelusers,
            'schedulesArray' => $schedulesArray,
            'modeltags' => $modeltags,
        ]);
    }

    /**
     * Deletes an existing Tblchannels model.
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
     * Finds the Tblchannels model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tblchannels the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tblchannels::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
