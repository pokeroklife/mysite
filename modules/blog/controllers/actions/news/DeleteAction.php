<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\controllers\NewsController;
use app\modules\blog\providers\NewsProvider;
use yii\base\Action;
use yii\web\Response;

class DeleteAction extends Action
{
    /**
     * @var NewsProvider $newsProvider
     */
    private $newsProvider;

    public function __construct($id, NewsController $controller, NewsProvider $newsProvider)
    {
        parent::__construct($id, $controller);
        $this->newsProvider = $newsProvider;
    }

    public function run(int $id): Response
    {
        if ($this->newsProvider->deleteNew($id)) {
            \Yii::$app->session->setFlash('success', 'success');
            return $this->controller->redirect('index');
        }

        \Yii::$app->session->setFlash('error', 'error');

        return $this->controller->redirect('view', ['id' => $id]);
    }
}