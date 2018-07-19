<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TblgamesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblgames-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'game_id') ?>

    <?= $form->field($model, 'team1') ?>

    <?= $form->field($model, 'team2') ?>

    <?= $form->field($model, 'time') ?>

    <?= $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
