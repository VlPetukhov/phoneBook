<?php

use yii\db\Migration;

class m160327_044011_creating_fultext_indexes extends Migration
{
    public function up()
    {
        $tableName = Yii::$app->db->quoteTableName('{{%phone}}');

        $sql = "CREATE FULLTEXT INDEX fullname_fulltext_idx ON $tableName ( surname, name )";

        $this->execute($sql);
    }

    public function down()
    {
        $this->dropIndex('fullname_fulltext_idx', '{{%phone}}');
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
