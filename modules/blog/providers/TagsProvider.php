<?php
declare(strict_types=1);

namespace app\modules\blog\providers;

use app\modules\blog\models\Tag;

class TagsProvider
{
    /**
     * @return Tag[]
     */
    public function getTags(): array  
    {
        return Tag::getTags();
    }

    public function getArticleWithTag(int $tagId): array
    {
        return Tag::findOne($tagId)->tagsArticles;
    }

//
}