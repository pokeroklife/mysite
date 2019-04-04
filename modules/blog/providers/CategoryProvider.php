<?php
declare(strict_types=1);

namespace app\modules\blog\providers;

use app\modules\blog\models\Categories;


class CategoryProvider
{
    /**
     * @return Categories[]
     */
    public function getCategories(): array
    {
        return Categories::getCategories();
    }

    public function getCategory(int $id): array
    {
        return Categories::findOne($id)->categoriesNews;
    }

    public function deleteCategory(int $id): bool
    {
        return Categories::deleteCategory($id);
    }
}