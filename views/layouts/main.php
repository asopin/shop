<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Shop',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    // TODO: to implement getCount() for ENH-4
    // $itemsInBasket = Yii::$app->baskets->getCount();

    // forms the top navigation menu items
    $navItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Basket', 'url' => ['/cart/list']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        array_push($navItems, [
            'label' => 'Sign In', 'url' => ['/user/login']
        ], [
            'label' => 'Sign Up', 'url' => ['/user/register']
        ]);
    } else {
        array_push($navItems, ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ]);
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $navItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <div class="col-md-2">
            <?php
            // show left menu items
            $leftMenuItems = [
                [
                    // TODO: add expanding menu based on categories tree
                    'label' => 'Product',
                    'url' => [
                        'product/index'
                    ],
                ],
                // TODO: this should be visible only to users with Admin/Moderator permissions
                [
                    'label' => 'Categories',
                    'url' => [
                        'categories/index'
                    ],
                ],
                [
                    'label' => 'Delivery Methods',
                    'url' => [
                        'delivery-methods/index'
                    ],
                ],
                [
                    'label' => 'Order Statuses',
                    'url' => [
                        'order-statuses/index'
                    ],
                ],
            ];
            echo Nav::widget([
                'items' => $leftMenuItems,
            ]);
            ?>
        </div>
        <div class="col-md-10">
            <!-- show content -->
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
