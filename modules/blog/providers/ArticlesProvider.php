<?php
declare(strict_types=1);

namespace app\modules\blog\providers;

use app\modules\blog\models\Articles;
use yii\db\ActiveRecord;

class ArticlesProvider
{
    /**
     * @return Articles[]
     */
    public function getArticles(): array
    {
        return Articles::getArticles();
    }

    public function getArticleCategoryTags(int $id): ActiveRecord
    {
        return Articles::getArticleCategoryTags($id);
    }
}
