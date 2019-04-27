<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\categories;

use app\modules\blog\controllers\CategoriesController;
use app\modules\blog\models\CategoriesCreateForm;
use app\modules\blog\providers\CategoryProvider;
use yii\base\Action;

/**
 * Class CreateAction
 * @package app\modules\blog\controllers\actions\categories
 */
class CreateAction extends Action
{
    /**
     * @var CategoryProvider
     */
    private $categoriesProvider;

    /**
     * CreateAction constructor.
     * @param $id
     * @param CategoriesController $controller
     * @param CategoryProvider $categoriesProvider
     */
    public function __construct($id, CategoriesController $controller, CategoryProvider $categoriesProvider)
    {
        parent::__construct($id, $controller);
        $this->categoriesProvider = $categoriesProvider;
    }

    /**
     * @return string
     */
    public function run(): string
    {
        $model = new CategoriesCreateForm();
        if ($model->load(\Yii::$app->request->post())
            && $model->validate()
            && $this->categoriesProvider->createCategory($model)) {
            \Yii::$app->session->setFlash('success', 'Категория сохранена');
        }
        return $this->controller->render('create', compact('model'));
    }
}