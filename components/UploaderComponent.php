<?php
declare(strict_types=1);

namespace app\components;

use yii\base\BaseObject;
use yii\base\Model;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * Class UploaderComponent
 * @package app\components
 */
class UploaderComponent extends BaseObject
{
    public const THUMBNAIL_WIDTH = 200;
    public const THUMBNAIL_HEIGHT = 120;
    public const THUMBNAIL_QUALITY = 100;

    /**
     * @param UploadedFile $file
     * @return string|null
     */
    public static function upload(UploadedFile $file): ?string
    {
        if (($file = UploadedFile::getInstance($model, 'image')) !== null
            && self::saveImage($file)
            && self::saveSmallImage($file)) {
            return "{$file->baseName}.{$file->extension}";

        }
        return null;
    }

    /**
     * @param UploadedFile $file
     * @return bool
     */
    public static function saveImage(UploadedFile $file): bool
    {
        $aliasImage = "@image/{$file->baseName}.{$file->extension}";
        if ($file->saveAs(\Yii::getAlias($aliasImage))) {
            return true;
        }
        return false;
    }

    /**
     * @param UploadedFile $file
     * @return bool
     */
    public static function saveSmallImage(UploadedFile $file): bool
    {
        $aliasImage = "@image/{$file->baseName}.{$file->extension}";
        $aliasSmallImage = "@smallImage/$file->baseName.$file->extension";
        if (Image::thumbnail($aliasImage, self::THUMBNAIL_WIDTH, self::THUMBNAIL_HEIGHT)
            ->save(\Yii::getAlias($aliasSmallImage), ['quality' => self::THUMBNAIL_QUALITY])) {
            return true;
        }
        return false;
    }
}
