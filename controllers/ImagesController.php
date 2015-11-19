<?php

namespace app\controllers;

use Yii;
use app\models\MultipleUploadForm;
use app\models\Product;
use app\models\Images;
use app\models\ImagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ImagesController implements the CRUD actions for Images model.
 */
class ImagesController extends Controller
{
    // trying to avoid exception 'yii\web\BadRequestHttpException' with message 'Missing required parameters: itemId' on delete
    // public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Images models.
     * @return mixed
     */
    public function actionIndex($itemId)
    {
        if (!Product::find()->where(['item_id' => $itemId])->exists()) {
            throw new NotFoundHttpException();
        }

        $form = new MultipleUploadForm();

        $searchModel = new ImagesSearch();
        $searchModel->item_id = $itemId;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->isPost) {
            $form->files = UploadedFile::getInstances($form, 'files');

            // debug Yii::trace($form);

            if ($form->files && $form->validate()) {
                foreach ($form->files as $file) {
                    $images = new Images();
                    $images->item_id = $itemId;

                    $images->big_image = $images->getPath();

                    // debug Yii::trace($images);

                    if ($images->save()) {
                        $file->saveAs($images->getPath());
                    }
                }
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'uploadForm' => $form,
        ]);
    }

    /**
     * Displays a single Images model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($itemId)
    {
        return $this->render('view', [
            'model' => $this->findModel($itemId),
        ]);
    }

    /**
     * Creates a new Images model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Images();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'imageId' => $model->image_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Images model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'imageId' => $model->image_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Images model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // debug
        Yii::trace($id);

        $image = $this->findModel($id);
        // debug
        Yii::trace($image);

        $itemId = $image->item_id;
        // debug
        Yii::trace($itemId);

        $image->delete();
        // debug
        Yii::trace($itemId);

        return $this->redirect(['index', 'itemId' => $itemId]);
    }

    /**
     * Finds the Images model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Images the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Images::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
