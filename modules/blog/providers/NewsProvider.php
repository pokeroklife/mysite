<?php
declare(strict_types=1);

namespace app\modules\blog\providers;

use app\modules\blog\models\News;
use app\modules\blog\models\NewsCreateForm;
use yii\db\ActiveRecord;

class NewsProvider
{
    /**
     * @return News[]
     */
    public function getNews(): array
    {
        return News::getNews();
    }

    public function getArticleCategory(int $id): ActiveRecord
    {
        return News::getArticleCategory($id);
    }

    public function getArticle(int $id): ActiveRecord
    {
        return News::getArticle($id);
    }

    public function getArticleTags(int $id): array
    {
        return News::findOne($id)->tags;
    }

    public function deleteArticle(int $id): bool
    {
        return News::deleteArticle($id);
    }

    public function createArticle(NewsCreateForm $model): ?News
    {
        return News::createArticle($model);
    }

}
