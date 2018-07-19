<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TblcommercialsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Commercials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblcommercials-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Commercials', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ad_id',
            'name',
            'url',
            [   
                'label' => '',
                'format' => 'raw',
                //'value'=> function($data) { return Html::a('&#9658;','uploads/'.$data->url); },
                'value' => function ($model) {                      
                  return "<audio controls='controls' preload='none'>
                            <source src='uploads/".$model->url."' type='audio/mp3' />
                          </audio>";
                },
            ],
            'duration',
            //'hexCode',
            [
                'attribute' => 'hexCode',
                'label' => 'hexCode',
                'format' => 'raw',
                'headerOptions' => ['style' => 'width:10%'],
                'value' => function ($model) {     
                    return "$model->hexCode <div style='height:20px;width:80px;background-color:$model->hexCode;'></div>"  ;
                },
            ],
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
