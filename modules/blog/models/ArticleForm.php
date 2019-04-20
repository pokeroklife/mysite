<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ArticleForm extends Model
{
    public $id;

    public $category;

    public $tags ;

    public $name;

    public $description;

    public $text;

    public $status;

    /** @var UploadedFile */
    public $image;

    public $authorId;

    const SCENARIO_UPDATE_ARTICLE = 'update';

    const SCENARIO_CREATE_ARTICLE = 'create';


    public function rules(): array
    {
        return [
            [['category', 'name', 'description', 'text', 'status', 'tags'], 'required'],
            [['image'], 'required', 'message' => 'Картинка отсутствует', 'on' => self::SCENARIO_CREATE_ARTICLE],
            [['name', 'description', 'text'], 'string', 'min' => 5],
            ['status', 'default', 'value' => 1],
            ['status', 'integer', 'min' => 0, 'max' => 1],
            [['image'], 'file', 'extensions' => ['gif', 'png', 'jpg']],
            [
                'name',
                'unique',
                'targetClass' => Articles::class,
                'message' => 'Эта новость уже существует',
                'on' => self::SCENARIO_CREATE_ARTICLE
            ],

        ];
    }
    
    public function attributeLabels():array
    {
        return [
            'category' => 'Категория новости',
            'name' => 'Название новости',
            'description' => 'Описание новости',
            'text' => 'Текст новости',
            'status' => 'Статус новости',
            'image' => 'Изображение новости',
            'tags' => 'Метки',

        ];
    }
}