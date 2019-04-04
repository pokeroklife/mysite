<?php


namespace app\modules\news\providers;

use app\modules\news\models\Categories;
use app\modules\news\models\News;


class CategoryProvider
{


    public function getCategoryName(): array
    {
        return Categories::getCategoryName();
    }

    public function getCategoryNews($category)
    {
        return News::getCategoryNews($category);
    }
}