<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tblgames */

$this->title = 'Update Games: ' . $model->game_id;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->game_id, 'url' => ['view', 'id' => $model->game_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tblgames-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modeltags' => $modeltags,
    ]) ?>

</div>
