<?php

namespace app\models;

use Yii;
use yii\validators\RequiredValidator;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $price
 * @property string $category
 * @property int $created_at
 */
class Product extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

//    public function scenarios()
//    {
//        return [
//            self::SCENARIO_DEFAULT => ['name'],
//        ];
//    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'created_at'], RequiredValidator::class],
            [['created_at'], 'integer'],
            [['category'], 'string', 'max' => 50],

            [['name'], 'string', 'max' => 20],
            [['name'], 'filter', 'filter' => function($value){
                return trim(strip_tags($value));
            }],

            [['price'], 'integer', 'min' => 1, 'max' => 999],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'category' => 'Category',
            'created_at' => 'Создан',
        ];
    }
}
