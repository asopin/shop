<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Baskets */

$this->title = Yii::t('app', 'Create Baskets');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Baskets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baskets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
