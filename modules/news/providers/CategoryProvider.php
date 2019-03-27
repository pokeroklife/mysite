<?php


namespace app\modules\news\providers;

use app\modules\news\models\Categories;


class CategoryProvider
{
    public function getCategoryName(): array
    {
        return Categories::getCategoryName();
    }


}