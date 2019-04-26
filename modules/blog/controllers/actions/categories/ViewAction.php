<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\categories;

use app\modules\blog\controllers\CategoriesController;
use app\modules\blog\providers\CategoryProvider;
use yii\base\Action;

/**
 * Class ViewAction
 * @package app\modules\blog\controllers\actions\categories
 */
class ViewAction extends Action
{
    /**
     * @var CategoryProvider $categoriesProvider
     */
    private $categoriesProvider;

    /**
     * ViewAction constructor.
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
     * @param int $id
     * @return string
     */
    public function run(int $id): string
    {
        $category = $this->categoriesProvider->getCategory($id);

        return $this->controller->render('view', compact('category'));
    }
}