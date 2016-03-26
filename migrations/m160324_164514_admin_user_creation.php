<?php

use app\models\User;
use yii\db\Migration;

class m160324_164514_admin_user_creation extends Migration
{
    public function up()
    {
        $user = new User(['scenario' => 'create']);

        $user->email = 'admin@example.com';
        $user->name = 'Administrator';
        $user->password = 'qwerty';

        return $user->save();
    }

    public function down()
    {
        /** @var \app\models\User $user */
        $user = User::findByEmail('admin@example.com');

        if ( $user ) {
            $user->delete();
        }

        return true;
    }
}
