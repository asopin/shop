<?php
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
 ?>

<div class="container">
    <div class="col-xs-2">
        <?php
            echo Nav::widget([
                'items' => $leftMenuItems,
            ]);
        ?>
    </div>
    <div class="col-md-10">
        <!-- show admin content -->
        <!-- show content -->
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <!-- //$content -->
    </div>
</div>
