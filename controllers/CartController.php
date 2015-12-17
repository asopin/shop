<?php

namespace app\controllers;

use Yii;
use app\models\Orders;
use app\models\OrderItem;
use app\models\Product;
use yz\shoppingcart\ShoppingCart;

class CartController extends \yii\web\Controller
{
    public function actionAdd($itemId)
    {
        $product = Product::findOne($itemId);
        if ($product) {
            \Yii::$app->cart->put($product);
            return $this->goBack();
        }
    }

    public function actionList()
    {
        /* @var $cart ShoppingCart */
        $cart = \Yii::$app->cart;

        $products = $cart->getPositions();
        $total = $cart->getCost();

        return $this->render('list', [
            'products' => $products,
            'total' => $total,
        ]);
    }

    public function actionRemove($itemId)
    {
        $product = Product::findOne($itemId);
        if ($product) {
            \Yii::$app->cart->remove($product);
            $this->redirect(['cart/list']);
        }
    }

    public function actionUpdate($itemId, $quantity)
    {
        $product = Product::findOne($itemId);
        if ($product) {
            \Yii::$app->cart->update($product, $quantity);
            $this->redirect(['cart/list']);
        }
    }

    public function actionOrder()
    {
        $order = new Orders();

        /* @var $cart ShoppingCart */
        $cart = \Yii::$app->cart;

        /* @var $products Product[] */
        $products = $cart->getPositions();
        $total = $cart->getCost();

        if ($order->load(Yii::$app->request->post()) && $order->validate()) {
            $transaction = $order->getDb()->beginTransaction();
            $order->save(false);

            foreach ($products as $product) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->order_id;
                $orderItem->item_id = $product->item_id;
                $orderItem->price = $product->getPrice();
                $orderItem->quantity = $product->getQuantity();
                if(!$orderItem->save(false)) {
                    $transaction->rollBack();
                    Yii::$app->session->addFlash('error', 'Cannot place your order. Please contact us.'); // TODO: may need to add Yii::t()
                    return $this->redirect('../'); // redirect to web root
                }
            }

            $transaction->commit();
            \Yii::$app->cart->removeAll();

            Yii::$app->session->addFlash('success', 'Thanks for your order. We\'ll contact you soon.');
            $order->sendEmail();

            return $this->redirect('../'); // redirect to web root
        }

        return $this->render('order', [
            'order' => $order,
            'products' => $products,
            'total' => $total,
        ]);
    }
}
