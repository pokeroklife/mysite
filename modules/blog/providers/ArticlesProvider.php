<?php
declare(strict_types=1);

namespace app\modules\blog\providers;

use app\modules\blog\models\ArticleForm;
use app\modules\blog\models\Articles;
use yii\db\ActiveQuery;
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

    public function getArticleCategory(int $id): ActiveRecord
    {
        return Articles::getArticleCategory($id);
    }

    public function getArticle(int $id): ActiveRecord
    {
        return Articles::getArticle($id);
    }

    public function getArticleTags(int $id): ActiveQuery
    {
        return Articles::findOne($id)->getTags();
    }

    public function deleteArticle(int $id): bool
    {
        return Articles::deleteArticle($id);
    }

    public function createArticle(ArticleForm $model): ?Articles
    {
        return Articles::createArticle($model);
    }

    public function updateArticle(ArticleForm $model,int $newsId): bool
    {
        return Articles::updateArticle($model, $newsId);
    }

    public function getOldModel(ArticleForm $model,int $id): ArticleForm
    {
        $dbModel = Articles::getArticle($id);
        $model->category = $dbModel->category;
        $model->name = $dbModel->name;
        $model->description = $dbModel->description;
        $model->text = $dbModel->text;
        $model->image = $dbModel->image;
        $model->status = $dbModel->status;

        return $model;
    }
}
