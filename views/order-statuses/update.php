<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrderStatuses */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Order Statuses',
]) . ' ' . $model->order_status_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->order_status_id, 'url' => ['view', 'id' => $model->order_status_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="order-statuses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
