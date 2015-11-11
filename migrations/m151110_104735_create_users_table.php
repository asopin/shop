<?php

use yii\db\Schema;
use yii\db\Migration;

class m151110_104735_create_users_table extends Migration
{
    public function up()
    {
        // not sure if needed because dektrium\user plugin will be used for user management

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /*
        CREATE TABLE `users` (
          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'user''s id',
          `login` varchar(20) NOT NULL COMMENT 'user''s login',
          `password` varchar(32) NOT NULL DEFAULT '' COMMENT 'user''s password',
          `email` varchar(100) NOT NULL DEFAULT '' COMMENT 'user''s email',
          PRIMARY KEY (`id`),
          UNIQUE KEY `login` (`login`),
          UNIQUE KEY `email` (`email`),
          KEY `login_password` (`login`,`password`) USING BTREE
         */

        $this->createTable('{{%users}}', [
            'id' => Schema::TYPE_PK,
            'login' => Schema::TYPE_STRING . ' NOT NULL DEFAULT ""',
            'password' => Schema::TYPE_STRING . ' NOT NULL DEFAULT ""',
            'email' => Schema::TYPE_STRING . ' NOT NULL DEFAULT " COMMENT "same for thumbnail image file"',
            'date_added' => Schema::TYPE_DATETIME . ' NOT NULL',
            'date_modified' => Schema::TYPE_DATETIME . ' NOT NULL',
            'role' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
        ], $tableOptions);

        // TODO: add keys and indices
    }

    public function down()
    {
        $this->dropTable('{{%users}}');
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
