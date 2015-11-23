<?php
use yii\helpers\Html;
use yii\helpers\Markdown;
?>
<?php /** @var $model \common\models\Product */ ?>
<div class="col-xs-12 well">
    <div class="col-xs-2">
        <?php
        $images = $model->images;
        if (isset($images[0])) {
            echo Html::img('images/' . $images[0]->getUrl(), ['width' => '100%']);
            // /Users/as/Sites/shop/web/images/54f304e99dab898319bc1d4c36828d09.jpg
        }
        ?>
    </div>
    <div class="col-xs-6">
        <h2><?= Html::encode($model->name) ?></h2>
        <?= Markdown::process($model->description) ?>
    </div>

    <div class="col-xs-4 price">
        <div class="row">
            <div class="col-xs-12">$<?= $model->price ?></div>
            <div class="col-xs-12"><?= Html::a('Add to basket', ['baskets/add', 'itemId' => $model->item_id], ['class' => 'btn btn-success'])?></div>
        </div>
    </div>
</div>
