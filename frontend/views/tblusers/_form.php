<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tblusers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblusers-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true,'onfocus'=>"this.value=''"]) ?>
    
    <table>
        <tr>
            <td> <?= $form->field($model, 'image')->fileInput(); ?></td>
            <td><?='<b>'.$model->image.'</b>';?></td>
        </tr>
    </table>

    <?= $form->field($model, 'broadcaster')->dropDownList([ '1'=>'Yes', '0'=>'No',], ['prompt' => '']) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>

    <h4> <b>Payment:</b></h4>
    <div class="panel panel-default">
        <div class="panel-body">

            <?= $form->field($model, 'ssn')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>

            <?= $form->field($model, 'paypal')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>

            <h5><b>Bank Information:</b></h5>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'routingNumber')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>
                        </div>
                        <div class="col-lg-6">   
                            <?= $form->field($model, 'bank_account_number')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success center-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
