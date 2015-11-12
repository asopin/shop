<?php

use yii\db\Schema;
use yii\db\Migration;

class m151110_104438_create_catalog_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        /*
            CREATE TABLE `catalog` (
              `item_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `category_id` int(11) unsigned NOT NULL,
              `name` varchar(100) NOT NULL DEFAULT '',
              `description` text,
              `price` decimal(10,2) DEFAULT NULL,
              `in_stock` int(11) NOT NULL,
              `date_added` datetime NOT NULL,
              `date_modified` datetime DEFAULT NULL,
              `active` tinyint(1) NOT NULL,
              PRIMARY KEY (`iitem_d`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
         */

        $this->createTable('{{%catalog}}', [
            'item_id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'price' => Schema::TYPE_DECIMAL . '(10,2) DEFAULT NULL',
            'in_stock' => Schema::TYPE_INTEGER . ' NOT NULL',           // quantity available in stock
            'date_added' => Schema::TYPE_DATETIME . ' NOT NULL',
            'date_modified' => Schema::TYPE_DATETIME . ' NOT NULL',
            'active' => Schema::TYPE_BOOLEAN . ' NOT NULL'
        ], $tableOptions);

        // TODO: add foreign key to categories table
    }

    public function down()
    {
        // TODO: drop foreign key to categories table

        $this->dropTable('{{%catalog}}');
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
