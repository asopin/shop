<?php

use yii\db\Schema;
use yii\db\Migration;

class m151206_132602_extend_orders_table_for_items extends Migration
{
    public function up()
    {
        // drop foreign key on item_id
        $this->dropForeignKey('orders_item_idFK', '{{%orders}}');

        // drop columns moved to order_item
        $this->dropColumn('{{%orders}}', 'item_id');
        $this->dropColumn('{{%orders}}', 'quantity');
        $this->dropColumn('{{%orders}}', 'price');
    }

    public function down()
    {
        // add columns back
        $this->addColumn('{{%orders}}', 'item_id', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addColumn('{{%orders}}', 'quantity', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addColumn('{{%orders}}', 'price', Schema::TYPE_DECIMAL . '(10,2) NOT NULL');

        // add foreign key on item_id
        $this->addForeignKey('orders_item_idFK', '{{%orders}}', 'item_id', '{{%product}}', 'item_id', 'CASCADE', 'CASCADE'); // foreign key 1..∞ from product.item_id to orders.item_id
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
