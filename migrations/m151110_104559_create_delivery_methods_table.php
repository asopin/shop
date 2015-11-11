<?php

use yii\db\Schema;
use yii\db\Migration;

class m151110_104559_create_delivery_methods_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /*
            CREATE TABLE `delivery_methods` (
            `delivery_method_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `delivery_method_name` varchar(20000) NOT NULL DEFAULT '',
            `delivery_method_price` decimal(10,2) unsigned NOT NULL,
            `date_added` datetime NOT NULL,
            `date_modified` datetime DEFAULT NULL,
         */

        $this->createTable( '{{%delivery_methods}}',[
             'delivery_method_id' => Schema::TYPE_PK,
             'delivery_method_name' => Schema::TYPE_STRING . ' NOT NULL DEFAULT ""',
             'delivery_method_price' => Schema::TYPE_DECIMAL . '(10,2) NOT NULL',
             'date_added' => Schema::TYPE_DATETIME . ' NOT NULL',
             'date_modified' => Schema::TYPE_DATETIME . ' NOT NULL',
         ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%delivery_methods}}')
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
