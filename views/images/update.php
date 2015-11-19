<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Images */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Images',
]) . ' ' . $model->image_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Images'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->image_id, 'url' => ['view', 'imageId' => $model->image_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="images-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
