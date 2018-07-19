<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Tbltags;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tbltags */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbltags-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_id')->dropDownList(
    	ArrayHelper::map(Tbltags::find()->all(),'tag_id','name'),
        [
            'prompt' => 'Select Tag Name...',
        ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success center-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
