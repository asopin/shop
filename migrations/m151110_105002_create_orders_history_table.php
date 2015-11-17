<?php

use yii\db\Schema;
use yii\db\Migration;

class m151110_105002_create_orders_history_table extends Migration
{
    public function up()
    {
        // TODO: create table
    }

    public function down()
    {
        $this->dropTable('{{%orders_history}}');
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
