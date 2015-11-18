<?php

use yii\db\Schema;
use yii\db\Migration;

class m151113_164249_extend_tables_for_created_by_updated_by extends Migration
{
    public function up()
    {
        // adds two fields to table to track who created or updated an item. For internal use
        // $this->addColumn('{{%product}}', 'created_by', Schema::TYPE_INTEGER . ' NOT NULL');
        // $this->addForeignKey('product_created_byFK', '{{%product}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addColumn('{{%product}}', 'updated_by', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addForeignKey('product_updated_byFK', '{{%product}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        $this->addColumn('{{%categories}}', 'created_by', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addForeignKey('categories_created_byFK', '{{%categories}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addColumn('{{%categories}}', 'updated_by', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addForeignKey('categories_updated_byFK', '{{%categories}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        $this->addColumn('{{%delivery_methods}}', 'created_by', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addForeignKey('delivery_methods_created_byFK', '{{%delivery_methods}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addColumn('{{%delivery_methods}}', 'updated_by', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addForeignKey('delivery_methods_updated_byFK', '{{%delivery_methods}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        $this->addColumn('{{%images}}', 'created_by', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addForeignKey('images_created_byFK', '{{%images}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addColumn('{{%images}}', 'updated_by', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addForeignKey('images_updated_byFK', '{{%images}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        $this->addColumn('{{%order_statuses}}', 'created_by', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addForeignKey('order_statuses_created_byFK', '{{%order_statuses}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addColumn('{{%order_statuses}}', 'updated_by', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addForeignKey('order_statuses_updated_byFK', '{{%order_statuses}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropForeignKey('product_updated_byFK', '{{%product}}');
        $this->dropColumn('{{%product}}', 'updated_by');

        $this->dropForeignKey('categories_created_byFK', '{{%categories}}');
        $this->dropColumn('{{%categories}}', 'created_by');
        $this->dropForeignKey('categories_updated_byFK', '{{%categories}}');
        $this->dropColumn('{{%categories}}', 'updated_by');

        $this->dropForeignKey('delivery_methods_created_byFK', '{{%delivery_methods}}');
        $this->dropColumn('{{%delivery_methods}}', 'created_by');
        $this->dropForeignKey('delivery_methods_updated_byFK', '{{%delivery_methods}}');
        $this->dropColumn('{{%delivery_methods}}', 'updated_by');

        $this->dropForeignKey('images_created_byFK', '{{%images}}');
        $this->dropColumn('{{%images}}', 'created_by');
        $this->dropForeignKey('images_updated_byFK', '{{%images}}');
        $this->dropColumn('{{%images}}', 'updated_by');

        $this->dropForeignKey('order_statuses_created_byFK', '{{%order_statuses}}');
        $this->dropColumn('{{%order_statuses}}', 'created_by');
        $this->dropForeignKey('order_statuses_updated_byFK', '{{%order_statuses}}');
        $this->dropColumn('{{%order_statuses}}', 'updated_by');

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
