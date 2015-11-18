<?php

use yii\db\Schema;
use yii\db\Migration;

class m151112_094748_extend_product_table_for_created_by extends Migration
{
    public function up()
    {
        // adds a field to product table to track who created an item. For internal use
        $this->addColumn('{{%product}}', 'created_by', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addForeignKey('product_created_byFK', '{{%product}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('product_created_byFK', '{{%product}}');
        $this->dropColumn('{{%product}}', 'created_by');
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
