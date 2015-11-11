<?php

use yii\db\Schema;
use yii\db\Migration;

class m151110_104533_create_categories_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /*
        CREATE TABLE `cathegories` (
        `cathegory_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `cathegory_name` varchar(100) NOT NULL DEFAULT '',
        `parent_cathegory_id` int(11) unsigned DEFAULT NULL,
        `date_added` datetime DEFAULT NULL,
        `date_modified` datetime DEFAULT NULL,
         */

        $this->createTable('{{%categories}}', [
         'category_id' => Schema::TYPE_PK,
         'category_name' => Schema::TYPE_STRING . ' NOT NULL DEFAULT ""',
         'parent_category_id' => Schema::TYPE_INTEGER, // . ' NOT NULL',    // can be null if this is a root level category
         'date_added' => Schema::TYPE_DATETIME . ' NOT NULL',
         'date_modified' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%categories}}');
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
