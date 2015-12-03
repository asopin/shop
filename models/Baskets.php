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

        // TODO: if exists then increment quantity. Otherwise add a record

        if ($existingItemForThisUser = $this->findOne(['user_id' => $userId, 'item_id' => $itemId])) {
            $existingItemForThisUser->quantity = $existingItemForThisUser->quantity + $quantity;

            // debug
            // var_dump($existingItemForThisUser);

            return $existingItemForThisUser;
        } else {
            $this->user_id = $userId;
            $this->item_id = $itemId;
            $this->quantity = $quantity; // TODO: FOR REFACTORING: May be need to change this to be a default value in database. Probably not.

            return $this;
        }
    }

    /**
     * Gets positions of current user
     * @param  Integer $userId
     * @return app/models/Baskets all Baskets records for given user_id
     */
    public function getPositions($userId)
    {
        // Here I need to return Baskets, but in Baskets I need to give an interface to both necessary Baskets fields and Product fields
        //
        // need to output:
        // product name - separate method
        // price - separate method
        // cost considering discount - separate method
        // quantity - separate method
        //
        //

        // get all products for this user
        $positions = $this->findAll(['user_id' => $userId]);

        // return all products and total for this user's basket
        return $positions;
    }

    /**
     * Returns total cost of item
     * @param  Integer $userId [description]
     * @return Float         Total cost of all items in given user's basket
     */
    public function getCost()
    {
        // TODO: return total cost of item
        return $this->getProductPrice() * $this->getQuantity();
    }

    /**
     * Returns total cost of basket for the user
     * @param  Integer $userId [description]
     * @return Float         total cost of basket for the user
     */
    public function getTotalCost($userId)
    {
        $products = $this->getPositions($userId);
        $totalCost = 0;

        foreach ($products as $product) {
            $totalCost += $product->getCost();
        }

        return $totalCost;
    }

    /**
     * [getProductName description]
     * @return String [description]
     */
    public function getProductName()
    {
        $product = Product::findOne($this->item_id);
        // debug var_dump($product);

        return $product->getName(); // $product->name;
    }

    /**
     * [getProductPrice description]
     * @return Float product price
     */
    public function getProductPrice()
    {
        $product = Product::findOne($this->item_id);
        // debug var_dump($product);

        return $product->getPrice();
    }

    /**
     * [getQuantity description]
     * @return Integer baskets' record quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

}
