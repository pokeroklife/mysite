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

    public function getArticle(int $id): ?ActiveRecord
    {
        return News::getArticle($id);
    }

    public function deleteArticle(int $id): bool
    {
        return News::deleteArticle($id);
    }

    public function setNews(NewsCreateForm $model): ?News
    {
        $article = new News([
            'categories_id' => $model->categories,
            'author_id' => $model->authorId,
            'name' => $model->name,
            'description' => $model->description,
            'text' => $model->text,
            'image' => $model->image,
            'status' => $model->status,
        ]);

        return $article->save() ? $article : null;
    }
}