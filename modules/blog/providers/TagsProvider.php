<?php
declare(strict_types=1);

namespace app\modules\blog\providers;

use app\modules\blog\models\News;
use app\modules\blog\models\NewsCreateForm;
use app\modules\blog\models\NewsTag;
use app\modules\blog\models\Tag;
use app\modules\blog\models\TagsCreateForm;

class TagsProvider
{
    /**
     * @return Tag[]
     */
    public function getTags(): array
    {
        return Tag::getTags();
    }

    public function getNewsWithTag(int $tagId): array
    {
        return Tag::findOne($tagId)->tagsNews;
    }

    public function createRelationArticleTags(NewsCreateForm $model, News $news): bool
    {
        return NewsTag::createRelationArticleTags($model, $news);
    }

    public function createTag(TagsCreateForm $model): bool
    {
        return Tag::createTag($model);
    }
}