<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TblusersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblusers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['placeholder'=>'Username','autocomplete'=>'off'])->label(false); ?>

    <?php ActiveForm::end(); ?>

</div>
