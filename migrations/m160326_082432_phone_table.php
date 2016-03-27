<?php

use yii\db\Migration;

class m160326_082432_phone_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ( 'mysql' === $this->db->driverName ) {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=MyISAM';
        }

        $this->createTable(
            '{{%phone}}',
            [
                'id' => $this->primaryKey(),
                'number' => $this->string(12)->unique()->notNull(),
                'surname' => $this->string(30)->notNull(),
                'name' => $this->string(50)->notNull(),
                'address' => $this->string()->notNull(),
                'description' => $this->string(512),
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%phone}}');
    }
}
