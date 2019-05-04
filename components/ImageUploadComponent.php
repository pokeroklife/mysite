<?php
declare(strict_types=1);

namespace app\components;

use yii\base\Component;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * Class ImageUploadComponent
 * @package app\components
 */
class ImageUploadComponent extends Component
{
    public const THUMBNAIL_WIDTH = 200;

    public const THUMBNAIL_HEIGHT = 120;

    public const THUMBNAIL_QUALITY = 100;

    /**
     * @var $image
     */
    public $image;

    private function getFolder(string $fileName): string
    {
        return \Yii::getAlias('@web') . "uploads/{$fileName}";
    }

    private function getFolderThumbnailImage(string $fileName): string
    {
        return \Yii::getAlias('@web') . "uploads/thumbnail/{$fileName}";
    }

    private function generateFileName(): string
    {
        return $this->image->baseName . time() . '.' . $this->image->extension;
    }

    public function deleteCurrentImage(string $currentImage): void
    {
        if (!empty($currentImage) && file_exists($this->getFolder($currentImage))) {
            unlink($this->getFolder($currentImage));
            unlink($this->getFolderThumbnailImage($currentImage));
        }
    }

    public function saveImage(UploadedFile $file): ?string
    {
        $this->image = $file;
        $fileName = $this->generateFileName();

        if ($this->image->saveAs($this->getFolder($fileName))) {
            $this->saveThumbnailImage($fileName);
            return $fileName;
        }

        return null;
    }

    public function saveThumbnailImage(string $fileName): void
    {
        Image::thumbnail($this->getFolder($fileName), self::THUMBNAIL_WIDTH, self::THUMBNAIL_HEIGHT)
            ->save($this->getFolderThumbnailImage($fileName), ['quality' => self::THUMBNAIL_QUALITY]);
    }
}