<?php
use \yii\helpers\Html;
use \yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $products app\models\Baskets ??? TODO: what model this should really be */
 ?>
<h1>Your order</h1>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-4">

        </div>
        <div class="col-xs-2">
            Price
        </div>
        <div class="col-xs-2">
            Quantity
        </div>
        <div class="col-xs-2">
            Cost
        </div>
    </div>
    <?php foreach ($products as $product):?>
        <div class="row">
            <div class="col-xs-4">
                <?= Html::encode($product->getProductName()) ?>
            </div>
            <div class="col-xs-2">
                $<?= $product->getProductPrice() ?>
            </div>
            <div class="col-xs-2">
                <?= $product->getQuantity() ?>
            </div>
            <div class="col-xs-2">
                $<?= $product->getCost() ?>
            </div>
        </div>
    <?php endforeach ?>
    <div class="row">
        <div class="col-xs-8">

        </div>
        <div class="col-xs-2">
            Total: $<?= $total ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <?php
            /* @var $form ActiveForm */
            $form = ActiveForm::begin([
                'id' => 'order-form',
            ]) ?>

            <?= $form->field($order, 'phone') ?>
            <?= $form->field($order, 'email') ?>
            <?= $form->field($order, 'notes')->textarea() ?>

            <!-- TODO: add delivery method selection -->

            <div class="form-group row">
                <div class="col-xs-12">
                    <?= Html::submitButton('Order', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
