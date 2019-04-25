<?php
declare(strict_types=1);

namespace app\modules\blog\providers;

use app\modules\blog\models\ArticleForm;
use app\modules\blog\models\Articles;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;

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

    public function deleteArticle(int $id): bool
    {
        return Articles::deleteArticle($id);
    }

    public function createArticle(ArticleForm $model): ?Articles
    {
        return Articles::createArticle($model);
    }

    public function updateArticle(array $articles): bool
    {
        return Articles::updateArticle($articles);
    }
//
//    public function getOldModel(ArticleForm $model,int $id): ArticleForm
//    {
//        $dbModel = Articles::getArticle($id);
//        $model->category = $dbModel->category;
//        $model->name = $dbModel->name;
//        $model->description = $dbModel->description;
//        $model->text = $dbModel->text;
//        $model->image = $dbModel->image;
//        $model->status = $dbModel->status;
//
//        return $model;
//    }
}
