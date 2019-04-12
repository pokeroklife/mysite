<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\categories;

use app\modules\blog\controllers\CategoriesController;
use app\modules\blog\models\CategoriesCreateForm;
use app\modules\blog\providers\CategoryProvider;
use yii\base\Action;

class CreateAction extends Action
{
    private $categoriesProvider;

    public function __construct($id, CategoriesController $controller, CategoryProvider $categoriesProvider)
    {
        parent::__construct($id, $controller);
        $this->categoriesProvider = $categoriesProvider;
    }

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