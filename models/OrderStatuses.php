<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_statuses".
 *
 * @property integer $order_status_id
 * @property string $order_status_name
 * @property string $order_status_description
 * @property string $date_added
 * @property string $date_modified
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Orders[] $orders
 */
class OrderStatuses extends \app\models\ShopActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_statuses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_status_description'], 'required'],
            // commented because date* and *by fields are handled by behaviors
            // , 'date_added', 'date_modified', 'created_by', 'updated_by'], 'required'],
            [['order_status_description'], 'string'],
            [['date_added', 'date_modified'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['order_status_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_status_id' => Yii::t('app', 'Order Status ID'),
            'order_status_name' => Yii::t('app', 'Order Status Name'),
            'order_status_description' => Yii::t('app', 'Order Status Description'),
            'date_added' => Yii::t('app', 'Date Added'),
            'date_modified' => Yii::t('app', 'Date Modified'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['order_status_id' => 'order_status_id']);
    }
}
