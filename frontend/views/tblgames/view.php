<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use frontend\models\Tbltags;
/* @var $this yii\web\View */
/* @var $model frontend\models\Tblgames */

$this->title = $model->game_id;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblgames-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->game_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->game_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'game_id',
            'team1',
            'team2',
            'time:datetime',
            [
                'attribute' => 'image',
                'format' => 'html',    
                'value' => function ($data) {
                    return Html::img(Yii::getAlias('@web').'/uploads/'. $data['image'],
                        ['width' => '150px']);
                },
            ],
            // [   'attribute' => '',
            //     'label' => 'Keywords',
            //     'value' => function($model){
            //             return  ArrayHelper::map(Tbltags::find()->all(),'tag_id','name');
            //     }
                
            // ],
            //'category',
            //'created_at',
            //'updated_at',
        ],
    ]) ?>

</div>
