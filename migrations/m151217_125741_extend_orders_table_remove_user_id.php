<?php

use yii\db\Schema;
use yii\db\Migration;

class m151217_125741_extend_orders_table_remove_user_id extends Migration
{
    public function up()
    {
        $this->dropForeignKey('orders_user_idFK', '{{%orders}}');

        $this->dropColumn('{{%orders}}', 'user_id');
    }

    public function down()
    {
        $this->addColumn('{{%orders}}', 'user_id', Schema::TYPE_INTEGER . ' NOT NULL');

        $this->addForeignKey('orders_user_idFK', '{{%orders}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE'); // foreign key 1..∞ from user.id to orders.user_id
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
