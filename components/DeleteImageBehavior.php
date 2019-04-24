<?php
declare(strict_types=1);

namespace app\components;


use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * Class DeleteImageBehavior
 * @package app\components
 */
class DeleteImageBehavior extends Behavior
{
    /**
     * @return array
     */
    public function events(): array
    {
        return [
            ActiveRecord::EVENT_BEFORE_DELETE => 'delete',
        ];
    }

    /**
     * @return void
     */
    public function delete(): void
    {
        $imageUploadModel = new ImageUploadComponent();
        $imageUploadModel->deleteCurrentImage($this->owner->image);
    }
}