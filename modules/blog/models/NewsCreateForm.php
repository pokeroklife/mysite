<?php
declare(strict_types=1);

namespace app\modules\blog\models;


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
            [['uploadImage'], 'file', 'extensions' => ['gif', 'png', 'jpg']],
            [
                'name',
                'unique',
                'targetClass' => News::class,
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

    public function insertNews():bool
    {
        if (!$this->validate()) {
            return false;
        }
        $newsData = new News();
        if (empty($newsData->upload_image = $this->upload())) {
            \Yii::$app->session->setFlash('success', 'Файл отсутствует');
            return false;
        } else {
            $newsData->author_id = \Yii::$app->user->id;
            $newsData->categories_id = $this->categories;
            $newsData->name = $this->name;
            $newsData->short_description = $this->newsDescription;
            $newsData->text = $this->newsText;
            $newsData->status = $this->newsStatus;
            return $newsData->save();
        }
    }

    public function upload():?string
    {
        if (empty($file = UploadedFile::getInstance($this, 'uploadImage'))) {
            return false;
        }
        $aliasImage = "@webroot/img/{$file->baseName}.{$file->extension}";
        $aliasSmallImage = "@webroot/img/small/$file->baseName.$file->extension";
        $file->saveAs(\Yii::getAlias($aliasImage));
        Image::thumbnail($aliasImage, 100, 60)
            ->save(\Yii::getAlias($aliasSmallImage), ['quality' => 100]);
        return ("{$file->baseName}.{$file->extension}");
    }
}