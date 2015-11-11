<?php

use yii\db\Schema;
use yii\db\Migration;

class m151110_104635_create_images_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /*
            CREATE TABLE `images` (
              `image_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `item_id` int(11) unsigned NOT NULL,
              `description` varchar(4000) NOT NULL DEFAULT '',
              `big_image` varchar(15000) NOT NULL DEFAULT '' COMMENT 'link to the image file in the file system. Maybe will store the image right in the database',
              `thumbnail` varchar(1800) NOT NULL DEFAULT '' COMMENT 'same for thumbnail image file',
              `date_added` datetime NOT NULL,
              `date_modified` datetime DEFAULT NULL,
         */

         $this->createTable('{{%images}}', [
            'image_id' => Schema::TYPE_PK,
            'item_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'description' => Schema::TYPE_STRING . ' NOT NULL DEFAULT ""',
            'big_image' => Schema::TYPE_STRING . ' NOT NULL DEFAULT "" COMMENT "link to the image file in the file system. Maybe will store the image right in the database"',
            'thumbnail' => Schema::TYPE_STRING . ' NOT NULL DEFAULT " COMMENT "same for thumbnail image file"',
            'date_added' => Schema::TYPE_DATETIME . ' NOT NULL',
            'date_modified' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);

        // TODO: add foreign key on item_id to catalog

    }

    public function down()
    {
        // TODO: drop foreign key

        $this->dropTable('{{%images}}');
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
