<?php

use yii\db\Schema;
use yii\db\Migration;

class m151207_071737_extend_orders_table_for_contacts extends Migration
{
    public function up()
    {
        // add phone, email and notes fields
        $this->addColumn('{{%orders}}', 'phone', Schema::TYPE_STRING . ' NOT NULL');
        $this->addColumn('{{%orders}}', 'email', Schema::TYPE_STRING . ' NOT NULL');
        $this->addColumn('{{%orders}}', 'notes', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('{{%orders}}', 'phone');
        $this->dropColumn('{{%orders}}', 'email');
        $this->dropColumn('{{%orders}}', 'notes');
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
