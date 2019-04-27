<?php
declare(strict_types=1);

namespace app\modules\blog\providers;

use app\modules\blog\models\Tag;

/**
 * Class TagsProvider
 * @package app\modules\blog\providers
 */
class TagsProvider
{
    /**
     * @return array
     */
    public function getTags(): array  
    {
        return Tag::getTags();
    }

    /**
     * @param int $tagId
     * @return array
     */
    public function getArticleWithTag(int $tagId): array
    {
        return Tag::findOne($tagId)->tagsArticles;
    }

//
}