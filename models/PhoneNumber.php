<?php
/**
 * @class PhoneNumber
 * @namespace app\models
 */

namespace app\models;


use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class PhoneNumber extends ActiveRecord
{
    public $fullname;

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%phone}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['number', 'surname', 'name', 'address'], 'required', 'on' => ['create']],
            [['number', 'address', 'description'], 'trim', 'on' => ['create', 'update']],

            [['number'], 'match', 'pattern' => '/^[+]?[\d ()-]+$/i', 'on' => ['create', 'update']],

            [['surname'], 'string', 'max' => 30, 'on' => ['create', 'update']],
            [['name'], 'string', 'max' => 50, 'on' => ['create', 'update']],
            [['address'], 'string', 'max' => 255, 'on' => ['create', 'update']],

            [['description'], 'string', 'max' => 512, 'on' => ['create', 'update']],

            [['id','fullname', 'surname', 'name', 'number', 'address'], 'safe', 'on' => 'search'],
        ];
    }

    public function clearNumber( $value )
    {
        return str_replace(
            [
                '+',
                '(',
                ')',
                ' ',
                '-'
            ],
            '',
            $value);
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if ( ! parent::beforeValidate() ) {

            return false;
        }

        $number = $this->clearNumber( $this->number );

        if ( 12 < strlen($number) ) {
            $this->addError('number', 'Phone number should contain 12 digits maximum.');

            return false;
        }

        return true;
    }

    /**
     * @param bool $insert
     *
     * @return bool
     */
    public function beforeSave( $insert )
    {
        if ( !parent::beforeSave( $insert )) {

            return false;
        }

        $this->number = $this->clearNumber( $this->number );

        return true;
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
        $query->andFilterWhere(['like', 'number', static::clearNumber($this->number)]);

        if ( isset($this->fullname) ) {
            $query->andWhere("MATCH( surname, name ) AGAINST ( :query_search IN BOOLEAN MODE)")
                ->addParams([':query_search' => $this->fullname . '*' ]);
        }

        $query->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;

    }

    /**
     * @param string $number
     *
     * @return string
     */
    public static function format( $number )
    {
        if ( !is_string($number) ) {

            return $number;
        }

        $formatted = '';
        $countryCode = '';
        $cityCode = '';
        $group1 = '';
        $group2 = '';
        $group3 = '';

        switch ( strlen( $number ) ) {
            /*International format*/
            case 12 :
                $countryCode = substr($number, -12, 2);

            case 11 :
                if ( empty($countryCode) ) { $countryCode = substr($number, -11, 1); };
                $formatted .= "+$countryCode ";

            case 10 :
                $cityCode = substr($number, -10, 3);

            case 9 :
                if ( empty($cityCode) ) { $cityCode = substr($number, -10, 2); };

            case 8 :
                if ( empty($cityCode) ) { $cityCode = substr($number, -9, 1); };
                $formatted .= "($cityCode) ";

            case 7 :
                $group1 = substr($number, -7, 3);

            case 6 :
                if ( empty($group1) ) { $group1 = substr($number, -6, 2); };

            case 5 :
                if ( empty($group1) ) { $group1 = substr($number, -5, 1); };
                $formatted .= "$group1-";

            case 4 :
                $group2 = substr($number, -4, 2);
                $formatted .= "$group2-";
                $group3 = substr($number, -2, 2);
                $formatted .= "$group3";
                break;

            default: $formatted = $number;
        }

        return $formatted;
    }
} 