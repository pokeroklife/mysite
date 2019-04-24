<?php
declare(strict_types=1);

namespace app\components;


use yii\base\Component;
use yii\imagine\Image;
use yii\web\UploadedFile;

class ImageUploadComponent extends Component
{
    /**
     * @var $image
     */
    public $image;

    public const THUMBNAIL_WIDTH = 200;

    public const THUMBNAIL_HEIGHT = 120;

    public const THUMBNAIL_QUALITY = 100;
    /**
     * @return string
     */
    private function getFolder(): string
    {
        return \Yii::getAlias('@web') . 'uploads/';
    }

    /**
     * @return string
     */
    private function getFolderThumbnailImage(): string
    {
        return \Yii::getAlias('@web') . 'uploads/thumbnail/';
    }

    /**
     * @return string
     */
    private function generateFileName(): string
    {
        return $this->image->baseName . time() . '.' . $this->image->extension;
    }
    /**
     * @param string $currentImage
     */
    public function deleteCurrentImage(string $currentImage): void
    {
        if ($this->fileExist($currentImage)) {
            unlink($this->getFolder() . $currentImage);
        }
    }
    /**
     * @param string $currentImage
     * @return bool
     */
    private function fileExist(string $currentImage): bool
    {
        if (!empty($currentImage) && $currentImage !== null) {
            return file_exists($this->getFolder() . $currentImage);
        }
        return false;

    }
    /**
     * @param UploadedFile $file
     * @return string
     */
    public function saveImage(UploadedFile $file): string
    {
        $this->image = $file;
        $fileName = $this->generateFileName();

        $this->image->saveAs($this->getFolder() . $fileName);
        $this->saveThumbnailImage($fileName);
        return $fileName;
    }

    /**
     * @param string $fileName
     * @return bool
     */
    public function saveThumbnailImage(string $fileName): bool
    {
        $aliasImage = $this->getFolder() . '/' . $fileName;
        $aliasSmallImage = $this->getFolderThumbnailImage() . '/' . $fileName;
        if (Image::thumbnail($aliasImage, self::THUMBNAIL_WIDTH, self::THUMBNAIL_HEIGHT)
            ->save(\Yii::getAlias($aliasSmallImage), ['quality' => self::THUMBNAIL_QUALITY])) {

            return true;
        }
        return false;
    }
}