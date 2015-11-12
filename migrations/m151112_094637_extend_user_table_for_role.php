<?php

use yii\db\Schema;
use yii\db\Migration;

class m151112_094637_extend_user_table_for_role extends Migration
{
    public function up()
    {
        // adds a role column to the dektrium\yii2-user's user table for role based access support
        $this->addColumn('{{%user}}', 'role', Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10');
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'role');
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
