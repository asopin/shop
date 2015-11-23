<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "baskets".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $item_id
 * @property integer $quantity
 * @property string $date_added
 * @property string $date_modified
 *
 * @property Product $item
 * @property User $user
 */
class Baskets extends yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'baskets';
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
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_added'],
                ],
                // TBU value because of the following:
                // http://stackoverflow.com/questions/30397789/use-db-expression-or-php-datetime-as-timestamp
                // One drawback with using DB Expressin in yii2 is that the model attribute is not updated after $model->save(). It stillcontains "new Expression('NOW()')". To get the actual value the model need to be loaded from database with "$model->refresh()". By using PHP datetime the final value is present right away. (Found that out when making a Rest API with the default Rest classes. After creating something the value echoed back still was an Expression and not a value.) – karpy47 Nov 8 at 17:19
                'value' => new Expression('NOW()'), // using new Expression('NOW()') instead of just time() because it is DB time format independent
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'item_id', 'quantity'], 'required'],

            // handled by behavior
            // 'date_added', 'date_modified'], 'required'],
            [['user_id', 'item_id', 'quantity'], 'integer'],
            [['date_added', 'date_modified'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'date_added' => Yii::t('app', 'Date Added'),
            'date_modified' => Yii::t('app', 'Date Modified'),
        ];
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

    /**
     * Adds one item to the basket
     * @param integer $itemId
     * @param integer $userId
     */
    public function put($userId, $itemId, $quantity = 1) {
        $this->user_id = $userId;
        $this->item_id = $itemId;
        $this->quantity = $quantity; // TODO: FOR REFACTORING: May be need to change this to be a default value in database. Probably not.
    }
}
