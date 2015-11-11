<?php

use yii\db\Schema;
use yii\db\Migration;

class m151110_104652_create_orders_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /*
        CREATE TABLE `orders` (
          `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `user_id` int(11) unsigned NOT NULL,
          `item_id` int(11) unsigned NOT NULL,
          `quantity` int(11) unsigned NOT NULL,
          `price` decimal(10,2) unsigned NOT NULL,
          `delivery_method_id` int(11) unsigned NOT NULL,
          `order_status_id` int(11) unsigned NOT NULL,
          `date_added` datetime NOT NULL,
          `date_modified` datetime DEFAULT NULL,
         */

         $this->createTable('{{%orders}}', [
            'order_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'item_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'quantity' => Schema::TYPE_INTEGER . ' NOT NULL',
            'price' => Schema::TYPE_DECIMAL . '(10,2) NOT NULL',
            'delivery_method_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'order_status_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date_added' => Schema::TYPE_DATETIME . ' NOT NULL',
            'date_modified' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);

        // TODO: add all necessary foreign keys
    }

    public function down()
    {
        // TODO: drop all foreign keys

        $this->dropTable('{{%orders}}');
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
