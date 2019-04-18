<?php
declare(strict_types=1);

namespace app\modules\blog\providers;

use yii\base\Model;
use yii\imagine\Image;
use yii\web\UploadedFile;

class ImageProvider
{
    public function upload(Model $model): ?string
    {

        if (($file = UploadedFile::getInstance($model, 'image')) === null) {

            return null;
        }
        $aliasImage = "@webroot/img/{$file->baseName}.{$file->extension}";
        $aliasSmallImage = "@webroot/img/small/$file->baseName.$file->extension";
        $file->saveAs(\Yii::getAlias($aliasImage));
        Image::thumbnail($aliasImage, 100, 60)
            ->save(\Yii::getAlias($aliasSmallImage), ['quality' => 100]);
        return "{$file->baseName}.{$file->extension}";
    }
}