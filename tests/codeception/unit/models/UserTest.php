<?php

namespace tests\codeception\unit\models;

use app\models\User;
use Yii;
use yii\codeception\TestCase;

class UserTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        // uncomment the following to load fixtures for user table
        //$this->loadFixtures(['user']);
    }

    public function testTableName()
    {
        $this->assertEquals('{{%user}}', User::tableName());
    }

    public function testRules()
    {
        $user = new User();
        $rules = $user->rules();
        $this->assertInternalType('array', $rules);
        $this->assertNotEmpty($rules);

        foreach ($rules as $rule) {

            $this->assertInternalType('array', $rule);
        }
    }

    public function testBeforeDelete()
    {
        $user = new User();

        $user->id = 1;
        $this->assertFalse($user->beforeDelete());

        $user->id = 2;
        $this->assertTrue($user->beforeDelete());
    }

    public function testBeforeSave()
    {
        $user = new User;

        $password = 'qwerty123456';

        $user->password = $password;

        $this->assertTrue($user->beforeSave(true));

        $this->assertTrue( Yii::$app->security->validatePassword($password, $user->password_hash) );
        $this->assertNotEmpty( $user->auth_key );
    }
}
