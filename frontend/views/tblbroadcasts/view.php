<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tblbroadcasts */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Broadcasts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblbroadcasts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'user_id',
            'game_id',
            [
                'attribute'=>'created_at',
                'label' => 'Created At(UTC)',
                $d =  $model->created_at/1000,
                'value'=> date('Y-m-d H:i:s',  $d),
            ],
            //'created_at',
            [
                'attribute'=>'updated_at',
                'label' => 'Updated At(UTC)',
                $d =  $model->updated_at/1000,
                'value'=> date('Y-m-d H:i:s',  $d),
            ],
            //'updated_at',
        ],
    ]) ?>

</div>
