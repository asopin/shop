<?php

namespace app\controllers;

use Yii;
use app\models\Baskets;
use app\models\BasketsSearch;
use app\models\Orders;
use app\models\OrderItem;
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
        $userId = Yii::$app->user->identity->id;

        $order = new Orders();
        $basket = new Baskets();

        $products = $basket->getPositions($userId);
        $total = $basket->getTotalCost($userId);

        if ($loadTest = $order->load($postTest = Yii::$app->request->post()) && $validateTest = $order->validate()) {

            $order->user_id = $userId;

            // STUB:
            $order->delivery_method_id = 2;
            $order->order_status_id = 1;

            $transaction = $order->getDb()->beginTransaction();
            $order->save(false);

            foreach($products as $product) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->order_id;
                // I don't have t title column in order_item table
                // $orderItem->title = $title

                $orderItem->item_id = $product->getItemId();
                $orderItem->price = $product->getProductPrice();
                $orderItem->quantity = $product->getQuantity();


                if (!$orderItem->save(false)) {
                    $transaction->rollBack();
                    Yii::$app->session->addFlash('error', 'Cannot place your order. Please contact us.');
                    return $this->redirect('../catalog/list');
                }
            }

            $transaction->commit();

            // TODO: add removal of the user's basket
            $basket->removeUserPositions($userId);

            Yii::$app->session->addFlash('success', 'Thanks for your order. We\'ll contact you soon.');

            // condition here just because no SMTP server configured yet
            if (Yii::$app->params['sendEmail']) {
                $order->sendEmail();
            }

            return $this->redirect('../catalog/list');
        }

        Yii::trace($order->getErrors());
        Yii::trace($loadTest); // . ' ' . $validateTest);
        Yii::trace($postTest); //
        // Yii::trace($validateTest);

        return $this->render('order', [
            'order' => $order,
            'products' => $products,
            'total' => $total,
        ]);
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
