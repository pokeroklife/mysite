<?php
declare(strict_types=1);

namespace app\modules\blog\providers;

use app\modules\blog\models\Articles;
use yii\db\ActiveRecord;

/**
 * Class ArticlesProvider
 * @package app\modules\blog\providers
 */
class ArticlesProvider
{
    /**
     * @return array
     */

    public function getArticles(): array
    {
        return Articles::getArticles();
    }

    /**
     * @param int $id
     * @return ActiveRecord
     */
    public function getArticleCategoryTags(int $id): ActiveRecord
    {
        return Articles::getArticleCategoryTags($id);
    }
}
