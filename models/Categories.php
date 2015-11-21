<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $category_id
 * @property string $category_name
 * @property integer $parent_category_id
 * @property string $date_added
 * @property string $date_modified
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Product[] $products
 * @property User $createdBy
 * @property User $updatedBy
 * @property Categories $parentCategory
 * @property Categories[] $categories
 */
class Categories extends \app\models\ShopActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_category_id', 'created_by', 'updated_by'], 'integer'],
            // commented because date* and *by fields are handled by behaviors
            // [['date_added', 'date_modified', 'created_by', 'updated_by'], 'required'],
            [['date_added', 'date_modified'], 'safe'],
            [['category_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('app', 'Category ID'),
            'category_name' => Yii::t('app', 'Category Name'),
            'parent_category_id' => Yii::t('app', 'Parent Category ID'),
            'date_added' => Yii::t('app', 'Date Added'),
            'date_modified' => Yii::t('app', 'Date Modified'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'category_id']);
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
    public function getParentCategory()
    {
        return $this->hasOne(Categories::className(), ['category_id' => 'parent_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::className(), ['parent_category_id' => 'category_id']);
    }

    /**
     * The purpose of this function is to prevent cycle reference on parent_category_id (otherwise possible when updating)
     *
     * @param integer $categoryId 
     * @return \yii\db\ActiveQuery
     */
    public function findAllExceptOne($categoryId)
    {
        return $this->find()->where(['not', ['category_id' => $categoryId]])->all();
    }
}
