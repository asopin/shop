<?php

namespace app\controllers;

use Yii;
use app\models\Baskets;
use app\models\BasketsSearch;
use app\models\Orders;
use app\models\Product;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BasketsController implements the CRUD actions for Baskets model.
 */
class BasketsController extends Controller
{
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
     * Lists all Baskets models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BasketsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Baskets model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Baskets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Baskets();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Baskets model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Baskets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Baskets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Baskets::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Adds and item to the basket
     * @param  [type] $itemId [description]
     * @return [type]         [description]
     */
    public function actionAdd($itemId)
    {
        $product = Product::findOne($itemId);

        // debug
        Yii::trace($product);

        if ($product) {
            // add item to the baskets table
            $model = new Baskets(); // TODO: FOR REFACTORING: change class Baskets to Basket. All these objects describe a single entity on a diagram

            $model = $model->put(Yii::$app->user->identity->id, $itemId);
            if($model->save())
            {
                $this->goBack();
            }
        }
    }

    /**
     * [actionList description]
     * @return [type] [description]
     */
    public function actionList()
    {
        $userId = Yii::$app->user->identity->id;

        // render current user's basket
        /* @var $cart ShoppingCart */
        $basket = new Baskets();

        $products = $basket->getPositions($userId);
        $total = $basket->getTotalCost($userId);

        return $this->render('list', [
           'products' => $products,
           'total' => $total,
        ]);
    }

    public function actionOrder()
    {
        // TODO: implement Orders and OrderItem properly
        //
        // DONE: add table OrderItem and alter Orders table to move item-related data to separate table with relation one to many by order_id

        $userId = Yii::$app->user->identity->id;

        $order = new Orders();
        $basket = new Baskets();

        $products = $basket->getPositions($userId);
        $total = $basket->getTotalCost($userId);

        if ($order->load(Yii::$app->request->post()) && $order->validate()) {
            $transaction = $order->getDb()->beginTransaction();
            $order->save(false);

            foreach($products as $product) {
                $orderItem = new OrderItem();

            }
        }
    }

    /**
     * Removes item from basket
     * @param  Integer $itemId [description]
     */
    public function actionRemove($itemId)
    {
        $product = Product::findOne($itemId);
        if ($product) {
            $model = new Baskets();

            $model = $model->removeItem(Yii::$app->user->identity->id, $itemId);
            Yii::trace($model);

            $this->redirect(['baskets/list']);
        }
    }

    /**
     * Updates an existing Baskets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($itemId, $quantity)
    {
        $product = Product::findOne($itemId);
        if ($product) {
            $model = new Baskets();

            $model = $model->updateQuantity(Yii::$app->user->identity->id, $itemId, $quantity);

            if($model->save()) {
                $this->redirect(['baskets/list']);
            }
        }
    }
}
