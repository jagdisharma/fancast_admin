<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TblusersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblusers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => function($model){
                    if($model->status == 0){
                        return['class'=>'danger'];  
                    }
                },
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['style' => 'width:100px;'],
                ],

                //'user_id',
                [   
                    'attribute'=>'username',
                    'value'=>'username',
                    'filter'=>true,
                    'headerOptions' => ['style' => 'min-width:20%; max-width:20%;'],
                ],
                [   
                    'attribute'=>'first_name',
                    'filter'=>false
                ],
                [   
                    'attribute'=>'last_name',
                    'filter'=>false
                ],
                 [   
                    'attribute'=>'email',
                    'filter'=>false
                ],
                //'password',
                //'image',
                //'broadcaster',
                //'description',
                //'followers',
                //'following',
                //'earnings',
                //'ssn',
                //'paypal',
                //'bank_account_number',
                //'routingNumber',
                //'deviceToken',
                //'deviceType',
                //'version',
                //'created_at',
                //'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <?php 
            $this->registerJs('jQuery("#w0-filters").on("keyup", "input", function(){
                jQuery(this).change();
            });',
            yii\web\View::POS_READY);
    ?>
    <script type="text/javascript">
        $(function() { //equivalent to document.ready
          $(".form-control").focus();
        });

        $('.form-control').focus(function(){
          var that = this;
          setTimeout(function(){that.selectionStart = that.selectionEnd = 10000; }, 0);
        });
    </script> 
 <?php Pjax::end(); ?>
   
</div>


