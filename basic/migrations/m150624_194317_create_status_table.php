<?php

use yii\db\Schema;
use yii\db\Migration;

class m150624_194317_create_status_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'sql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDb';
        }

        $this->createTable('{{%status}}', [
            'id' => Schema::TYPE_PK,
            'message' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
            'permissions' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%status}}');
    }
}
