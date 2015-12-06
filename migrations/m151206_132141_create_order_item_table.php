<?php

use yii\db\Schema;
use yii\db\Migration;

class m151206_132141_create_order_item_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        /*
        CREATE TABLE `orders` (
          `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `item_id` int(11) unsigned NOT NULL,
          `quantity` int(11) unsigned NOT NULL,
          `price` decimal(10,2) unsigned NOT NULL,
          `date_added` datetime NOT NULL,
          `date_modified` datetime DEFAULT NULL,
         */

         $this->createTable('{{%order_item}}', [
            'order_id' => Schema::TYPE_INTEGER . ' NOT NULL',  // TYPE_PK,
            'item_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'quantity' => Schema::TYPE_INTEGER . ' NOT NULL',
            'price' => Schema::TYPE_DECIMAL . '(10,2) NOT NULL',
            'date_added' => Schema::TYPE_DATETIME . ' NOT NULL',
            'date_modified' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);

        $this->addForeignKey('order_item_order_idFK', '{{%order_item}}', 'order_id', '{{%orders}}', 'order_id', 'CASCADE', 'CASCADE'); // foreign key 1..∞ from product.item_id to orders.item_id

        $this->addForeignKey('order_item_item_idFK', '{{%order_item}}', 'item_id', '{{%product}}', 'item_id', 'CASCADE', 'CASCADE'); // foreign key 1..∞ from product.item_id to orders.item_id

    }

    public function down()
    {
        $this->dropForeignKey('order_item_item_idFK', '{{%order_item}}');
        $this->dropForeignKey('order_item_order_idFK', '{{%order_item}}');
        $this->dropTable('{{%order_item}}');
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
