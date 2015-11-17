<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DeliveryMethods */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Delivery Methods',
]) . ' ' . $model->delivery_method_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Delivery Methods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->delivery_method_id, 'url' => ['view', 'id' => $model->delivery_method_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="delivery-methods-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
