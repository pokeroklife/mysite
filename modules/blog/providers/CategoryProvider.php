<?php
declare(strict_types=1);

namespace app\modules\blog\providers;

use app\modules\blog\models\Categories;
use app\modules\blog\models\CategoriesCreateForm;

/**
 * Class CategoryProvider
 * @package app\modules\blog\providers
 */
class CategoryProvider
{
    /**
     * @return array
     */
    public function getCategories(): array
    {
        return Categories::getCategories();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getCategory(int $id): array
    {
        return Categories::findOne($id)->categoriesArticles;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteCategory(int $id): bool
    {
        return Categories::deleteCategory($id);
    }

    /**
     * @param CategoriesCreateForm $model
     * @return bool
     */
    public function createCategory(CategoriesCreateForm $model): bool
    {
        return Categories::createCategory($model);
    }




}