<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $item_id
 * @property integer $quantity
 * @property string $price
 * @property integer $delivery_method_id
 * @property integer $order_status_id
 * @property string $date_added
 * @property string $date_modified
 *
 * @property DeliveryMethods $deliveryMethod
 * @property OrderStatuses $orderStatus
 * @property Product $item
 * @property User $user
 */
class Orders extends \app\models\ShopActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'item_id', 'quantity', 'price', 'delivery_method_id', 'order_status_id', 'date_added', 'date_modified'], 'required'],
            [['user_id', 'item_id', 'quantity', 'delivery_method_id', 'order_status_id'], 'integer'],
            [['price'], 'number'],
            [['date_added', 'date_modified'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'Order ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'price' => Yii::t('app', 'Price'),
            'delivery_method_id' => Yii::t('app', 'Delivery Method ID'),
            'order_status_id' => Yii::t('app', 'Order Status ID'),
            'date_added' => Yii::t('app', 'Date Added'),
            'date_modified' => Yii::t('app', 'Date Modified'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryMethod()
    {
        return $this->hasOne(DeliveryMethods::className(), ['delivery_method_id' => 'delivery_method_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderStatus()
    {
        return $this->hasOne(OrderStatuses::className(), ['order_status_id' => 'order_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Product::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
