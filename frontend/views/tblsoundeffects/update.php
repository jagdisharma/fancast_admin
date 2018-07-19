<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tblsoundeffects */

$this->title = 'Update Sound Effects: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sound Effects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->sound_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tblsoundeffects-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
