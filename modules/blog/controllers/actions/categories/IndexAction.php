<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\categories;

use app\modules\blog\controllers\CategoriesController;
use app\modules\blog\providers\CategoryProvider;
use yii\base\Action;

/**
 * Class IndexAction
 * @package app\modules\blog\controllers\actions\categories
 */
class IndexAction extends Action
{
    /**
     * @var CategoryProvider $categoriesProvider
     */
    private $categoriesProvider;

    /**
     * IndexAction constructor.
     * @param $id
     * @param CategoriesController $controller
     * @param CategoryProvider $categoriesProvider
     */
    public function __construct(
        $id,
        CategoriesController $controller,
        CategoryProvider $categoriesProvider
    ) {
        parent::__construct($id, $controller);
        $this->categoriesProvider = $categoriesProvider;
    }

    /**
     * @return string
     */
    public function run(): string
    {
        $categories = $this->categoriesProvider->getCategories();
        return $this->controller->render('index', compact('categories'));
    }
}