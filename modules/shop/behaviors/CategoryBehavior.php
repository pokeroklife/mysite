<?php
declare(strict_types=1);

namespace app\modules\shop\behaviors;

use app\modules\shop\models\ProductsCategory;
use \yii\db\ActiveRecord;

/**
 * Class CategoryBehavior
 * @package app\modules\shop\behaviors
 */
class CategoryBehavior extends \yii\base\Behavior
{
    public function events(): array
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'create',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'create',
            ActiveRecord::EVENT_AFTER_DELETE => 'delete',
        ];
    }

    public function create(): void
    {
       $category = ProductsCategory::findOne(['id' => $this->owner->category_id]);
       if($category === null) {
            $category = ProductsCategory::setCategory($this->owner->category_id);
           $this->owner->category_id = $category->id;
       }
    }

//    /**
//     * @return void
//     * @throws Exception
//     * @property Articles $this->owner->id
//     */
//    public function update(): void
//    {
//        try {
//            ArticlesTag::deleteArticleTags($this->owner->id);
//            $this->create();
//
//        } catch (Exception $e) {
//            throw $e;
//        }
//    }

    public function delete()
    {

    }
}