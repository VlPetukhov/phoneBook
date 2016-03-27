<?php

use yii\db\Migration;

class m160324_155110_user_table_creation extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ( 'mysql' === $this->db->driverName ) {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%user}}',
            [
                'id' => $this->primaryKey(),
                'email' => $this->string()->unique()->notNull(),
                'name' => $this->string(),
                'auth_key' => $this->string(32),
                'password_hash' => $this->string(60)->notNull(),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
