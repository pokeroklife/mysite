<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use yii\base\Model;


class CategoriesCreateForm extends Model
{
    public $name;

    public $status;


    public function rules(): array
    {
        return [
            [['name', 'status'], 'required'],
            [['name'], 'string', 'min' => 5],
            ['status', 'default', 'value' => 1],
            ['status', 'integer', 'min' => 0, 'max' => 1],
            [
                'name',
                'unique',
                'targetClass' => Categories::class,
                'message' => 'Эта новость уже существует'
            ],

        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Название категории',
            'status' => 'Статус категории',
        ];
    }
}