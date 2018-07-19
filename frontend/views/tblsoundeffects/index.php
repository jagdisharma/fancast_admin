<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TblsoundeffectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sound Effects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblsoundeffects-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sound Effects', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'sound_id',
            'name',
            'hexCode',
            [
                'label' => '',
                'format' => 'raw',
                'headerOptions' => ['style' => 'width:10%'],
                'value' => function ($model) {     
                    return  "<div style='height:20px;width:80px;background-color:$model->hexCode;'></div>"  ;
                },
            ],
            //'url:url',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
