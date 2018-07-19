<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Tbltags;
//use frontend\models\Tbltags;
/* @var $this yii\web\View */
/* @var $model frontend\models\Tbltags */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbltags-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->tag_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->tag_id], [
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
            //'tag_id',
            'name',
            //'p_id',
            [   'label' => 'p_id',
                'value' => function ($model) {
                    if ($model->p_id != 0 && ($tag = Tbltags::findOne($model->p_id)) !== null) {
                        return $tag->name;
                    } else {
                        return "";
                    }
                }
            ],
            //'created_at',
            //'updated_at',
        ],
    ]) ?>

</div>
