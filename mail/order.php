<?php
/* @var $order common\models\Order */
use yii\helpers\Html;
?>

<h1>New order #<?= $order->order_id ?></h1>

<ul>
    <li>Phone: <?= Html::encode($order->phone) ?></li>
    <li>Email: <?= Html::encode($order->email) ?></li>
</ul>

<h2>Notes</h2>

<?= Html::encode($order->notes) ?>

<h2>Items</h2>

<ul>
    <?php
    $sum = 0;
    foreach ($order->orderItems as $orderItem): ?>
        <?php $sum += $orderItem->quantity * $orderItem->price ?>
        <li><?= Html::encode($orderItem->item->name . ' x ' . $orderItem->quantity . ' x ' . $orderItem->price . '$') ?></li>
    <?php endforeach ?>
</ul>

<p><string>Total: </string> <?php echo $sum ?>$</p>
