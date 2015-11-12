<?php

use yii\db\Schema;
use yii\db\Migration;

class m151112_080142_create_init_foreign_keys extends Migration
{
    public function up()
    {
        $this->addForeignKey('baskets_user_idFK', '{{%baskets}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE'); // foreign key 1..∞ from user.id to baskets.user_id
        $this->addForeignKey('orders_user_idFK', '{{%orders}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE'); // foreign key 1..∞ from user.id to orders.user_id
        $this->addForeignKey('delivery_method_idFK', '{{%orders}}', 'delivery_method_id', '{{%delivery_methods}}', 'delivery_method_id', 'CASCADE', 'CASCADE'); // foreign key 1..∞ from delivery_methods.delivery_method_id to orders.delivery_method_id
        $this->addForeignKey('order_status_idFK', '{{%orders}}', 'order_status_id', '{{%order_statuses}}', 'order_status_id', 'CASCADE', 'CASCADE'); // foreign key 1..∞ from order_statuses.order_status_id to orders.order_status_id
        $this->addForeignKey('baskets_item_idFK', '{{%baskets}}', 'item_id', '{{%catalog}}', 'item_id', 'CASCADE', 'CASCADE'); // foreign key 1..∞ from catalog.item_id to baskets.item_id
        $this->addForeignKey('orders_item_idFK', '{{%orders}}', 'item_id', '{{%catalog}}', 'item_id', 'CASCADE', 'CASCADE'); // foreign key 1..∞ from catalog.item_id to orders.item_id
        $this->addForeignKey('images_item_idFK', '{{%images}}', 'item_id', '{{%catalog}}', 'item_id', 'CASCADE', 'CASCADE'); // foreign key 1..∞ from catalog.item_id to images.item_id
        $this->addForeignKey('category_idFK', '{{%catalog}}', 'category_id', '{{%categories}}', 'category_id', 'CASCADE', 'CASCADE'); // foreign key 1..∞ from catalog.category_id to categories.category_id
        $this->addForeignKey('parent_category_idFK', '{{%categories}}', 'parent_category_id', '{{%categories}}', 'category_id', 'CASCADE', 'CASCADE'); // foreign key 1..∞ from categories.category_id to categories.parent_category_id
    }

    public function down()
    {
        $this->dropForeignKey('baskets_user_idFK', '{{%baskets}}');
        $this->dropForeignKey('orders_user_idFK', '{{%orders}}');
        $this->dropForeignKey('delivery_method_idFK', '{{%orders}}');
        $this->dropForeignKey('order_status_idFK', '{{%orders}}');
        $this->dropForeignKey('baskets_item_idFK', '{{%baskets}}');
        $this->dropForeignKey('orders_item_idFK', '{{%orders}}');
        $this->dropForeignKey('images_item_idFK', '{{%images}}');
        $this->dropForeignKey('category_idFK', '{{%catalog}}');
        $this->dropForeignKey('parent_category_idFK', '{{%categories}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
