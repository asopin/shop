<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $form app\models\MultipleUploadForm */

// initial version
// $this->title = Yii::t('app', 'Images');

$this->title = $searchModel->item_id ? "Product #$searchModel->item_id images" : 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!-- Initial version
    <p>
        <?= Html::a(Yii::t('app', 'Create Images'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
 -->

    <?php if ($searchModel->item_id) : ?>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

            <?= $form->field($uploadForm, 'files[]')->fileInput(['multiple' => true]) ?>

            <button class="btn btn-primary">Upload</button>
        <?php ActiveForm::end() ?>
    <?php endif ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'image_id',
            'big_image',
            [
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    /** @var $model app\models\Images */
                    return Html::img($model->getUrl());
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]); ?>


<!-- Initial version
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'image_id',
            'item_id',
            'description',
            'big_image',
            'thumbnail',
            // 'date_added',
            // 'date_modified',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
 -->
</div>
