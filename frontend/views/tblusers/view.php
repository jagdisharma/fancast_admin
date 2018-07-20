<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tblusers */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblusers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?php $new = $model->status;?>
        <?php if($new == 1){?>
                 <?= Html::a('Block', ['block', 'id' => $model->user_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to block this User',
                        'method' => 'post',
                    ],
                ]) ?>
      <?php  }else{?>
                 <?= Html::a('UnBlock', ['unblock', 'id' => $model->user_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to block this User',
                        'method' => 'post',
                    ],
                ]) ?>
           <?php }
        ?>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'user_id',
            'username',
            'first_name',
            'last_name',
            'email',
            //'password',
            [
                'attribute' => 'image',
                'format' => 'html',    
                'value' => function ($data) {
                    return Html::img(Yii::getAlias('@web').'/uploads/'. $data['image'],
                        ['width' => '150px']);
                },
            ],
            //'broadcaster',
            [
                'attribute' => 'broadcaster',
                'value' => ($model->broadcaster == '0') ? 'No' : 'Yes',
            ],
            'description',
            //'followers',
            //'following',
            //'earnings',
            'ssn',
            'paypal',
            'bank_account_number',
            'routingNumber',
            //'deviceToken',
            //'deviceType',
            //'version',
            // [
            //     'attribute'=>'created_at',
            //     'label' => 'Created At(UTC)',
            //     'value'=> date('Y-m-d H:i:s'),
            // ],
            //'created_at',
            // [
            //     'attribute'=>'updated_at',
            //     'label' => 'Updated At(UTC)',
            //     'value'=> date('Y-m-d H:i:s'),
            // ],
            //'updated_at',
        ],
    ]) ?>

</div>
