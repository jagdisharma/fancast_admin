<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tblsoundeffects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sound Effects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblsoundeffects-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->sound_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->sound_id], [
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
            //'sound_id',
            'name',
            'hexCode',
            'url',
            // [
            //     'attribute' => 'url',
            //     'format' => 'html',    
            //     'value' => function ($data) {
            //         return Html::img(Yii::getAlias('@web').'/uploads/'. $data['url'],
            //             ['width' => '150px']);
            //     },
            // ],
            // [
            //     'attribute'=>'created_at',
            //     'label' => 'Created At(UTC)',
            //     'value'=> date('Y-m-d H:i:s'),
            // ],
            //'created_at',
            // [
            //     'attribute'=>'updated_at',
            //     'label' => 'Updated At(UTC)',
            //     'value'=> date('Y-m-d H:i:s'),
            // ],
            //'updated_at',
        ],
    ]) ?>

</div>
