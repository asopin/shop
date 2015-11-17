<?php

use yii\db\Schema;
use yii\db\Migration;

class m151110_104705_create_order_statuses_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        /*
        CREATE TABLE `order_statuses` (
          `order_status_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `order_status_name` varchar(100) NOT NULL DEFAULT '',
          `order_status_description` varchar(20000) NOT NULL DEFAULT '',
          `date_added` datetime NOT NULL,
          `date_modified` datetime DEFAULT NULL,
        */

        $this->createTable('{{%order_statuses}}', [
            'order_status_id' => Schema::TYPE_PK,
            'order_status_name' => Schema::TYPE_STRING . ' NOT NULL DEFAULT ""',
            'order_status_description' => Schema::TYPE_TEXT . ' NOT NULL',
            'date_added' => Schema::TYPE_DATETIME . ' NOT NULL',
            'date_modified' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%order_statuses}}');
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
