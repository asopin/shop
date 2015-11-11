<?php

use yii\db\Schema;
use yii\db\Migration;

class m151110_104253_create_baskets_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

/*
CREATE TABLE `baskets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `item_id` int(11) unsigned DEFAULT NULL,
  `quantity` int(11) unsigned DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_idFK` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 */

        $this->createTable('{{%baskets}}', [
                'id' => Schema::TYPE_PK,
                'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'item_id' =>Schema::TYPE_INTEGER . ' NOT NULL',
                'quantity' => Schema::TYPE_INTEGER . ' NOT NULL',
                'date_added' => Schema::TYPE_DATETIME . ' NOT NULL',
                'date_modified' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);
        $this->addForeignKey('fk_baskets_user_id', '{{%baskets}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_baskets_user_id', '{{%baskets}}');
        $this->dropTable('{{%baskets}}');
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
