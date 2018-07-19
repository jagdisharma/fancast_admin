<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Tbltags;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TbltagsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbltags-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tags', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'model' => $model,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'tag_id',
            'name',
            //'p_id',
            [
                'attribute'=>'p_id',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
