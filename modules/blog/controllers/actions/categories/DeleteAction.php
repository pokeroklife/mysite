<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\categories;

use app\modules\blog\controllers\CategoriesController;
use app\modules\blog\providers\CategoryProvider;
use yii\base\Action;
use yii\web\Response;

class DeleteAction extends Action
{
    /**
     * @var CategoryProvider $categoriesProvider
     */
    private $categoriesProvider;

    public function __construct($id, CategoriesController $controller, CategoryProvider $categoriesProvider)
    {
        parent::__construct($id, $controller);
        $this->categoriesProvider = $categoriesProvider;
    }

    public function run(int $id): Response
    {
        if ($this->categoriesProvider->deleteCategory($id)) {
            \Yii::$app->session->setFlash('success', 'success');
            return $this->controller->redirect('index');
        }

        \Yii::$app->session->setFlash('error', 'error');

        return $this->controller->redirect('view', ['id' => $id]);
    }
}