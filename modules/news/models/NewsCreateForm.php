<?php
/**
 * Created by PhpStorm.
 * User: Романенко
 * Date: 25.03.2019
 * Time: 19:24
 */

namespace app\modules\news\models;


use yii\base\Model;
use yii\imagine\Image;
use yii\web\UploadedFile;

class NewsCreateForm extends Model
{
    public $categories;
    public $name;
    public $newsDescription;
    public $newsText;
    public $newsStatus;
    /** @var UploadedFile */
    public $uploadImage;


    public function rules(): array
    {
        return [
            [['categories', 'name', 'newsDescription', 'newsText', 'newsStatus'], 'required'],
            [['name', 'newsDescription', 'newsText'], 'string', 'min' => 5],
            ['newsStatus', 'default', 'value' => 1],
            ['newsStatus', 'integer', 'min' => 0, 'max' => 1],
            [['uploadImage'], 'file'],
            [
                'name',
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
            'uploadImage' => 'Изображение новости',

        ];
    }

    public function saveNews()
    {
        if (!$this->validate()) {
            return null;
        }

        $newsData = new NewsCreate();
        $newsData->author_id = \Yii::$app->user->id;
        $newsData->name = $this->name;
        $newsData->short_description = $this->newsDescription;
        $newsData->text = $this->newsText;
        $newsData->status = $this->newsStatus;
        if (\Yii::$app->request->isPost) {
            $this->uploadImage = $this->upload();
        }
        $newsData->upload_image = $this->uploadImage;

        return $newsData->save() ? $newsData : null;
    }

    public function setRelations($info): bool
    {
        $relations = new CategoriesNews();
        $relations->categories_id = $this->categories;
        $relations->news_id = $info->id;

        return $relations->save() ?? null;
    }

    public function upload()
    {
        $file = UploadedFile::getInstance($this, 'uploadImage');
        $aliasImage = "@webroot/img/$file->baseName.$file->extension";
        $aliasSmallImage = "@webroot/img/small/$file->baseName.$file->extension";
        $file->saveAs(\Yii::getAlias($aliasImage));
        Image::thumbnail($aliasImage, 100, 60)
            ->save(\Yii::getAlias($aliasSmallImage), ['quality' => 100]);
        return ("{$file->baseName}.{$file->extension}");
    }
}