<?php

namespace app\controllers;

use app\models\Categories;
use app\models\Product;
use app\models\Images;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class CatalogController extends Controller
{
    /*
     * remembers url from which user navigated to catalog
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Url::remember();
            return true;
        } else {
            return false;
        }
    }

    public function actionList($categoryId = null)
    {
        /** @var Category $category */
        $category = null;

        $categories = Categories::find()->indexBy('category_id')->orderBy('category_id')->all();

        $productsQuery = Product::find();
        if ($categoryId !== null && isset($categories[$categoryId])) {
            $category = $categories[$categoryId];
            $productsQuery->where(['category_id' => $this->getCategoryIds($categories, $categoryId)]);
        }

        $productsDataProvider = new ActiveDataProvider([
            'query' => $productsQuery,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('list', [
            'category' => $category,
            'menuItems' => $this->getMenuItems($categories, isset($category->category_id) ? $category->category_id : null),
            'productsDataProvider' => $productsDataProvider,
        ]);
    }

    public function actionView()
    {
        return $this->render('view');
    }

    /**
     * @param Category[] $categories
     * @param int $activeId
     * @param int $parent
     * @return array
     */
    private function getMenuItems($categories, $activeId = null, $parent = null)
    {
        $menuItems = [];
        foreach ($categories as $category) {
            if ($category->parent_category_id === $parent) {
                $menuItems[$category->category_id] = [
                    'active' => $activeId === $category->category_id,
                    'label' => $category->category_name,
                    'url' => ['catalog/list', 'categoryId' => $category->category_id],
                    'items' => $this->getMenuItems($categories, $activeId, $category->category_id),
                ];
            }
        }
        return $menuItems;
    }

    /**
     * Returns IDs of category and all its sub-categories
     *
     * @param Category[] $categories all categories
     * @param int $categoryId id of category to start search with
     * @param array $categoryIds
     * @return array $categoryIds
     */
    private function getCategoryIds($categories, $categoryId, &$categoryIds = [])
    {
        foreach ($categories as $category) {
            if ($category->category_id == $categoryId) {
                $categoryIds[] = $category->category_id;
            }
            elseif ($category->parent_category_id == $categoryId){
                $this->getCategoryIds($categories, $category->category_id, $categoryIds);
            }
        }
        return $categoryIds;
    }
}

 ?>
