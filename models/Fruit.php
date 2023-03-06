<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fruit".
 *
 * @property int $id
 * @property string|null $genus
 * @property string|null $name
 * @property string|null $family
 * @property string|null $order
 * @property numeric|null $carbohydrates
 * @property numeric|null $protein
 * @property numeric|null $fat
 * @property numeric|null $calories
 * @property numeric|null $sugar
 *
 */
class Fruit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fruit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['genus', 'name', 'family', 'order'], 'string', 'max' => 255],
            [['carbohydrates', 'protein', 'fat', 'calories', 'sugar'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'genus' => 'Genus',
            'name' => 'Name',
            'family' => 'Family',
            'order' => 'Order',
            'carbohydrates' => 'Carbohydrates',
            'protein' => 'Protein',
            'fat' => 'Fat',
            'calories' => 'Calories',
            'sugar' => 'Sugar',
        ];
    }


    public function attributes()
    {
        return array_merge(parent::attributes(), ['nutrition_sum']);
    }
}
