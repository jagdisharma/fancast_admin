<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use frontend\models\Tblusers;
use frontend\models\Tblchannels;
use frontend\models\Tbltags;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model frontend\models\Tblchannels */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblchannels-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'autocomplete'=>'off'])->label('Title') ?>

    <?= $form->field($model, 'time')->widget(DateTimePicker::classname(), [
        'options' => [
                        'placeholder' => 'Enter time ...',
                        'autocomplete'=>'off',
                        'readonly'=>true,
                    ],
        'layout' => '{picker}{input}{remove}',
      
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-d h:i'
        ]
    ]);?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>

    <table>
        <tr>
            <td> <?= $form->field($model, 'image')->fileInput(); ?></td>
            <td><?='<b>'.$model->image.'</b>';?></td>
        </tr>
    </table>
    <?php if($model->isNewRecord) { ?>
        <?= $form->field($modeltags, 'tag_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Tbltags::find()->all(),'tag_id','name'),
                    'options' =>[
                                    'placeholder' => 'Select tag ...',
                                    'multiple' => true, 
                                ],
            ])->label('Keywords');
        ?>
    <?php } else { ?>
        <?= $form->field($modeltags, 'tag_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Tbltags::find()->all(),'tag_id','name'),
                    'options' =>[
                                    'placeholder' => 'Select tag ...',
                                    'multiple' => true, 
                                ],
            ])->label('Keywords');
        ?>
    <?php } ?>
    <?= $form->field($model, 'user_id')->dropDownList($schedulesArray,
        [
            'prompt' => 'Select username...',
    ])->label('Username') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success center-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
