<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use yii\base\Model;
use yii\web\UploadedFile;

class NewsCreateForm extends Model
{
    public $id;

    public $categories;

    public $tags ;

    public $name;

    public $description;

    public $text;

    public $status;

    /** @var UploadedFile */
    public $image;

    public $imagePath;

    public $authorId;


    public function rules(): array
    {
        return [
            [['categories', 'name', 'description', 'text', 'status', 'tags'], 'required'],
            [['image'], 'required', 'message' => 'Картинка отсутствует'],
            [['name', 'description', 'text'], 'string', 'min' => 5],
            [['imagePath'], 'string'],
            ['status', 'default', 'value' => 1],
            ['status', 'integer', 'min' => 0, 'max' => 1],
            [['image'], 'file', 'extensions' => ['gif', 'png', 'jpg']],
            [
                'name',
                'unique',
                'targetClass' => News::class,
                'message' => 'Эта новость уже существует'
            ],

        ];
    }

    public function attributeLabels():array
    {
        return [
            'categories' => 'Категория новости',
            'name' => 'Название новости',
            'description' => 'Описание новости',
            'text' => 'Текст новости',
            'status' => 'Статус новости',
            'image' => 'Изображение новости',
            'tags' => 'Метки',

        ];
    }
}