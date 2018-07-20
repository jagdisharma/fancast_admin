<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use frontend\models\Tbltags;
/* @var $this yii\web\View */
/* @var $model frontend\models\Tblgames */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblgames-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'team1')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>

    <?= $form->field($model, 'team2')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>

    <?= $form->field($model, 'time')->widget(DateTimePicker::classname(), [
        'options' => [
                        'placeholder' => 'Enter time ...',
                        'autocomplete'=>'off',
                        'readonly'=>true,
                        'value'=> date("Y-m-d H:i",$model->time),
                    ],
        'layout' => '{picker}{input}{remove}',
        
        'pluginOptions' => [
            'autoclose' => true,
            //'format' => 'mm/dd/yyyy hh:ii'
        ]
    ]);?>

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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success center-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
