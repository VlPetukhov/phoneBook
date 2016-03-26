<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $password;
    public $password_repeat;

    /*
     * AR Implementation
     */

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [

            ['name', 'required', 'on' => ['create']],
            ['name', 'filter', 'filter' => 'trim', 'on' => ['create', 'update']],
            ['name', 'match', 'pattern' => '/^[\w_ -]+$/i', 'on' => ['create', 'update']],
            ['name', 'string', 'min' => 3, 'max' => 255, 'on' => ['create', 'update']],

            ['email', 'required', 'on' => ['create']],
            ['email', 'filter', 'filter' => 'trim', 'on' => ['create', 'update']],
            ['email', 'email', 'on' => ['create', 'update']],
            ['email', 'unique', 'on' => ['create', 'update']],

            [['password', 'password_repeat'], 'required', 'on' => ['create']],
            [['password', 'password_repeat'], 'string', 'min' => 6, 'on' => ['create', 'update']],
            [['password', 'password_repeat'], 'match', 'pattern' => '/^[\w_~!@#$-]+$/i', 'on' => ['create', 'update']],
            [['password'] , 'compare', 'on' => ['create', 'update']],

            [['id', 'email', 'name'], 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return bool
     */
    public function beforeDelete(){
        //Easiest way to prevent deleting of admin user with id = 1;
        if ( !parent::beforeDelete() || 1 == $this->id) {
            return false;
        }

        return true;
    }

    /**
     * @param bool $insert
     *
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ( !parent::beforeSave($insert) ) {
             return false;
        }

        if ( $this->isNewRecord ) {
            $this->generateAuthStr();
        }

        if ( isset($this->password) ) {
            $this->generatePasswordHash();
        }

        return true;
    }

    /**
     * @throws \yii\base\Exception
     */
    protected function generatePasswordHash()
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash( $this->password );
    }

    /**
     * @param $password
     *
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param string $email
     *
     * @return null|static
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Generate Auth Key
     */
    public function generateAuthStr()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @return ActiveDataProvider
     */
    public function search( $params )
    {
        $query = $this->find();

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );

        if ( !($this->load($params) && $this->validate())) {

            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;

    }


    /*
     *  Interface implementation
     */

    /**
     * @param int $id
     *
     * @return null|static
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @param string $token
     * @param null  $type
     *
     * @return null|static
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // access by token is not allowed
        return null;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }
}
