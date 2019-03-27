<?php
/**
 * Created by PhpStorm.
 * User: Романенко
 * Date: 25.03.2019
 * Time: 19:24
 */

namespace app\modules\news\models;


use yii\base\Model;
use yii\web\Controller;

class NewsCreateForm extends Model
{
    public $categories;
    public $name;
    public $newsDescription;
    public $newsText;
    public $newsStatus;


    public function rules()
    {
        return [
            [['categories', 'name', 'newsDescription', 'newsText', 'newsStatus'], 'required'],
            [['name', 'newsDescription', 'newsText'], 'string', 'min' => 5],
            ['newsStatus', 'default', 'value' => 1],
            ['newsStatus', 'integer', 'min' => 0, 'max' => 1],
            ['name',
                'unique',
                'targetClass' => NewsCreate::class,
                'message' => 'Эта новость уже существует'
            ],

        ];
    }

    public function attributeLabels()
    {
        return [
            'categories' => 'Категория новости',
            'name' => 'Название новости',
            'newsDescription' => 'Описание новости',
            'newsText' => 'Текст новости',
            'newsStatus' => 'Статус новости',

        ];
    }

    public function saveNews()
    {
        if(!$this->validate()){
            return null;
        }

        $newsData = new NewsCreate();
        $newsData->author_id = \Yii::$app->user->id;
        $newsData->name = $this->name;
        $newsData->short_description = $this->newsDescription;
        $newsData->text = $this->newsText;
        $newsData->status = $this->newsStatus;


        return $newsData->save() ?? null;
    }
}