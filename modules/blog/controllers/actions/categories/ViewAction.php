<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\categories;

use app\modules\blog\controllers\CategoriesController;
use app\modules\blog\providers\CategoryProvider;
use yii\base\Action;

class ViewAction extends Action
{
    /**
     * @var CategoryProvider $categoriesProvider
     */
    private $categoriesProvider;

    public function __construct(
        $id,
        CategoriesController $controller,
        CategoryProvider $categoriesProvider
    ) {
        parent::__construct($id, $controller);
        $this->categoriesProvider = $categoriesProvider;
    }

    public function run(int $id): string
    {
        $category = $this->categoriesProvider->getCategory($id);

        return $this->controller->render('view', compact('category'));
    }
}