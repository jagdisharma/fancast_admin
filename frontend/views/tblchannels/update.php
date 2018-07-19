<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tblchannels */

$this->title = 'Update Channels: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Channels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->channel_id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tblchannels-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelusers' => $modelusers,
        'schedulesArray' => $schedulesArray,
        'modeltags' => $modeltags,
    ]) ?>

</div>
