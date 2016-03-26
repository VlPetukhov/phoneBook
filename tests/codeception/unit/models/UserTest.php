<?php

namespace tests\codeception\unit\models;

use app\models\User;
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
}
