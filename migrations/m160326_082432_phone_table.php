<?php

use yii\db\Migration;

class m160326_082432_phone_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ( 'mysql' === $this->db->driverName ) {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%phone}}',
            [
                'id' => $this->primaryKey(),
                'number' => $this->string(12)->unique()->notNull(),
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
