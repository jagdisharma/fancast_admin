<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;
/* @var $this yii\web\View */
/* @var $model frontend\models\Tblcommercials */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblcommercials-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <table>
        <tr>
            <td><?= $form->field($model, 'url')->fileInput(['id'=>'file-audio','required'=>true]); ?></td>
            <td><?='<b>'.$model->url.'</b>';?></td>
        </tr>
    </table>

    <?= $form->field($model, 'hexCode')->widget(ColorInput::classname(), [
            'options' => [
                            'placeholder' => 'Choose your color ...',
                            'readonly'=>true,
                        ],
        ]); 
    ?>

	<div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success center-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
