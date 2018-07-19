<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Tblchannels */

$this->title = 'Create Channels';
$this->params['breadcrumbs'][] = ['label' => 'Channels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblchannels-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelusers' => $modelusers,
        'schedulesArray' => $schedulesArray,
        'modeltags' => $modeltags,
    ]) ?>

</div>
