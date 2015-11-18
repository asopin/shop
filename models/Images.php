<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property integer $image_id
 * @property integer $item_id
 * @property string $description
 * @property string $big_image
 * @property string $thumbnail
 * @property string $date_added
 * @property string $date_modified
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property User $createdBy
 * @property Product $item
 * @property User $updatedBy
 */
class Images extends \app\models\ShopActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'date_added', 'date_modified', 'created_by', 'updated_by'], 'required'],
            [['item_id', 'created_by', 'updated_by'], 'integer'],
            [['date_added', 'date_modified'], 'safe'],
            [['description', 'big_image', 'thumbnail'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image_id' => Yii::t('app', 'Image ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'description' => Yii::t('app', 'Description'),
            'big_image' => Yii::t('app', 'Big Image'),
            'thumbnail' => Yii::t('app', 'Thumbnail'),
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
    public function getItem()
    {
        return $this->hasOne(Product::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
