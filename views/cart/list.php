<?php
use \yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $products app\models\Product[] */
?>
<h1>Your cart</h1>

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
        <div class="col-xs-2">

        </div>
    </div>
    <?php foreach ($products as $product):?>
    <div class="row">
        <div class="col-xs-4">
            <?= Html::encode($product->getName()) ?>
        </div>
        <div class="col-xs-2">
            $<? $product->getPrice() ?>
        </div>
        <div class="col-xs-2">
            <?= $quantity = $product->getQuantity()?>

            <?= Html::a('-', ['cart/update', 'itemId' => $product->getId(), 'quantity' => $quantity - 1], ['class' => 'btn btn-danger', 'disabled' => ($quantity - 1) < 1]) ?>
            <?= Html::a('+', ['cart/update', 'itemId' => $product->getId(), 'quantity' => $quantity + 1], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-xs-2">
            <?= $product->getCost() ?>
        </div>
        <div class="col-xs-2">
            <?= Html::a('x', ['cart/remove', 'itemId' => $product->getId(), 'quantity' => $quantity - 1], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
    <?php endforeach ?>
    <div class="row">
        <div class="col-xs-8">

        </div>
        <div class="col-xs-2">
            Total: $<?= $total ?>
        </div>
        <div class="col-xs-2">
            <?= Html::a('Order', ['cart/order'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
