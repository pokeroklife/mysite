<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use yii\base\Model;

/**
 * Class CategoriesCreateForm
 * @package app\modules\blog\models
 */
class CategoriesCreateForm extends Model
{
    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $status;

    /**
     * @return array
     */

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

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'name' => 'Название категории',
            'status' => 'Статус категории',
        ];
    }
}