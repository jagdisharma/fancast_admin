<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Tblgames;
use frontend\models\Tblgamestags;
use frontend\models\TblgamesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use frontend\models\Tbltags;
/**
 * TblgamesController implements the CRUD actions for Tblgames model.
 */
class TblgamesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tblgames models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblgamesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['updated_at'=>SORT_DESC])->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tblgames model.
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
     * Creates a new Tblgames model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tblgames();
        $modeltags = new Tbltags();
        $mt = explode(' ', microtime());
        $new = ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));

        if ($model->load(Yii::$app->request->post())) {
            $request = Yii::$app->request->post();
            $file= UploadedFile::getInstance($model,'image');
            if($file){
                $imagename = 'games_Picture_'.$new;
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
            $game_id = $model['game_id'];
            if(isset($request['Tbltags']) && !empty($request['Tbltags'])){
                $tagId = $request['Tbltags']['tag_id'];
                //echo"<pre>";print_r($tagId);exit();
                foreach($tagId as $tag){
                    $modelgamestags = new Tblgamestags();
                    $modelgamestags->game_id = $game_id;
                    $modelgamestags->tag_id = $tag;  
                    $modelgamestags->created_at = time();
                    $modelgamestags->updated_at = time();    
                    $modelgamestags->save();        
                }
            }
            return $this->redirect(['view', 'id' => $model->game_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'modeltags' => $modeltags,
        ]);
    }

    /**
     * Updates an existing Tblgames model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {   
        $model = $this->findModel($id);
        $old_tags = array();
        $modelgamestags = Tblgamestags::find()->where(['game_id' => $id])->all();

        if(!empty($modelgamestags)) {
            foreach ($modelgamestags as $modelgamestag) {
                $tag[]=$modelgamestag->tag_id;
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
                $modelgamestags = new Tblgamestags;    
            }
        }else{
            $modeltags = new Tbltags();
        }

        $oldfile = $model->image;
        $mt = explode(' ', microtime());
        $new = ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));

        if ($model->load(Yii::$app->request->post()) ) {
            $request = Yii::$app->request->post();
            $fileprev = 'uploads/'.$oldfile;
            $imagename = 'games_Picture_'.$new;
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
            $game_id = $model['game_id'];
            $newTags = $request['Tbltags']['tag_id'];

            if(!empty($newTags)) {
                foreach($newTags as $tagSelect) {
                    // if new tag selected add to database
                    if(!in_array($tagSelect,$old_tags)){
                        // save tag to database with respect to channel id
                        $modelgamestags = new Tblgamestags();
                        $modelgamestags->game_id = $game_id;
                        $modelgamestags->tag_id = $tagSelect;  
                        $modelgamestags->created_at = time();
                        $modelgamestags->updated_at = time();    
                        $modelgamestags->save();  
                    }
                } 
            } else {
                // delete all if no tags selected 
                foreach($old_tags as $otag) {
                    // remove it from database w.r.t channel id
                    \Yii::$app
                    ->db
                    ->createCommand()
                    ->delete('TBL_GAMES_TAGS', ['game_id'=>$game_id,'tag_id'=>$otag])
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
                        ->delete('TBL_GAMES_TAGS', ['game_id'=>$game_id,'tag_id'=>$otag])
                        ->execute();
                    }
                }      
            }
            return $this->redirect(['view', 'id' => $model->game_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'modeltags' => $modeltags,
        ]);
    }

    /**
     * Deletes an existing Tblgames model.
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
     * Finds the Tblgames model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tblgames the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tblgames::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
