<?php

use yii\db\Schema;
use yii\db\Migration;

class m151112_094748_extend_catalog_table_for_created_by extends Migration
{
    public function up()
    {
        // adds a field to catalog table to track who created an item. For internal use
        $this->addColumn('{{%catalog}}', 'created_by', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addForeignKey('catalog_created_byFK', '{{%catalog}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('catalog_created_byFK', '{{%catalog}}');
        $this->dropColumn('{{%catalog}}', 'created_by');
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
