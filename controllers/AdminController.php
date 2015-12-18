<?php

namespace app\controllers;

/**
 * Returns admin page arrays to view (this makes admin views extended easily)
 */

// Need to think how to form these arrays. Probably I need to take them from DB? or hardcode values?
//
// First I'll hardcode
//
// Starting from just returning links

use Yii;
use yii\web\Controller;

/**
 *
 */
class AdminController extends Controller
{

    public function actionList()
    {


        // Check for user role. Only admins can see it, otherwise redirect back
        //
        // if !admin TODO: condition should be really for admin
        if (!Yii::$app->user->getIsGuest()) {
            $leftMenuItems = [
                [
                    // TODO: add expanding menu based on categories tree
                    'label' => 'Product',
                    'url' => [
                        'product/index'
                    ],
                ],
                // TODO: this should be visible only to users with Admin/Moderator permissions
                [
                    'label' => 'Categories',
                    'url' => [
                        'categories/index'
                    ],
                ],
                [
                    'label' => 'Delivery Methods',
                    'url' => [
                        'delivery-methods/index'
                    ],
                ],
                [
                    'label' => 'Order Statuses',
                    'url' => [
                        'order-statuses/index'
                    ],
                ],
            ];

            return
                // array of key values
                $this->render('list', [
                    'leftMenuItems' => $leftMenuItems
                ]);

        } else {
        // redirect back
            $this->goBack();
        }
    }
}

 ?>
