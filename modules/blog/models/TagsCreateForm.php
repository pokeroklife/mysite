<?php
declare(strict_types=1);

namespace app\modules\blog\models;


use yii\base\Model;

class TagsCreateForm extends Model
{
    public $name;

    public $status;


    public function rules(): array
    {
        return [
            [['name', 'status'], 'required'],
            [['name'], 'string'],
            ['status', 'default', 'value' => 1],
            ['status', 'integer', 'min' => 0, 'max' => 1],
            [
                'name',
                'unique',
                'targetClass' => Tag::class,
                'message' => 'Этот тэг уже существует'
            ],

        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Название тэга',
            'status' => 'Статус тэга',
        ];
    }
}
