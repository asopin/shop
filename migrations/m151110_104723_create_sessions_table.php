<?php

use yii\db\Schema;
use yii\db\Migration;

class m151110_104723_create_sessions_table extends Migration
{
    public function up()
    {
        // not sure if this table is needed because Yii provides its own sessions functionality

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /*
        CREATE TABLE `sessions` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `user_id` int(11) NOT NULL,
          `session` varchar(32) NOT NULL,
          `time` int(10) unsigned NOT NULL,
         */

         $this->createTable('{{%sessions}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'session' => Schema::TYPE_STRING . '(32) NOT NULL DEFAULT ""',
            'date_added' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%sessions}}');
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
