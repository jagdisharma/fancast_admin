<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Tblcommercials */

$this->title = 'Create Commercials';
$this->params['breadcrumbs'][] = ['label' => 'Commercials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblcommercials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
