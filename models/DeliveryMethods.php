<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery_methods".
 *
 * @property integer $delivery_method_id
 * @property string $delivery_method_name
 * @property string $delivery_method_price
 * @property string $date_added
 * @property string $date_modified
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Orders[] $orders
 */
class DeliveryMethods extends \app\models\ShopActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery_methods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['delivery_method_price'], 'required'],
            // commented because date* and *by fields are handled by behaviors
            // , 'date_added', 'date_modified', 'created_by', 'updated_by'], 'required'],
            [['delivery_method_price'], 'number'],
            [['date_added', 'date_modified'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['delivery_method_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'delivery_method_id' => Yii::t('app', 'Delivery Method ID'),
            'delivery_method_name' => Yii::t('app', 'Delivery Method Name'),
            'delivery_method_price' => Yii::t('app', 'Delivery Method Price'),
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
        return $this->hasMany(Orders::className(), ['delivery_method_id' => 'delivery_method_id']);
    }
}
