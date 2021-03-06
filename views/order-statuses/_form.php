<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderStatuses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-statuses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_status_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_status_description')->textarea(['rows' => 6]) ?>

<!-- removed because these fields are handled by behaviors
    <?= $form->field($model, 'date_added')->textInput() ?>

    <?= $form->field($model, 'date_modified')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>
-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
