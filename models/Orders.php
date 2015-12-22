<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "orders".
 *
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $delivery_method_id
 * @property integer $order_status_id
 * @property string $date_added
 * @property string $date_modified
 * @property string $phone
 * @property string $email
 * @property string $notes
 *
 * @property OrderItem[] $orderItems
 * @property DeliveryMethods $deliveryMethod
 * @property OrderStatuses $orderStatus
 * @property User $user
 */
class Orders extends yii\db\ActiveRecord
{
    const STATUS_NEW = 1; //'New';
    const STATUS_IN_PROGRESS = 'In progress';
    const STATUS_DONE = 'Done';

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
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_added', 'date_modified'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_modified'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['user_id', 'delivery_method_id', 'order_status_id', 'date_added', 'date_modified', 'phone', 'email'], 'required'],
            [['phone' , 'email'], 'required'],
            [['delivery_method_id', 'order_status_id'], 'integer'],
            [['date_added', 'date_modified'], 'safe'],
            [['phone', 'email', 'notes'], 'string', 'max' => 255],
            ['order_status_id', 'default', 'value' => self::STATUS_NEW],   // Set order status New if order_status_id passed empty. TODO: think about the best way to give default value without using magic numbers. This can be moved to init()
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
            'delivery_method_id' => Yii::t('app', 'Delivery Method ID'),
            'order_status_id' => Yii::t('app', 'Order Status ID'),
            'date_added' => Yii::t('app', 'Date Added'),
            'date_modified' => Yii::t('app', 'Date Modified'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'notes' => Yii::t('app', 'Notes'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'order_id']);
    }

    // public function beforeSave($insert)
    // {
    //     if (parent::beforeSave($insert)) {
    //         if ($this->isNewRecord) {
    //             $this->order_status_id = self::STATUS_NEW;
    //         }
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function sendEmail()
    {

        return Yii::$app->mailer->compose('order', ['order' => $this])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setSubject('New order #' . $this->order_id)
            ->send();
    }
}
