<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\controllers\ArticlesController;
use app\modules\blog\providers\ArticlesProvider;
use yii\base\Action;
use yii\web\Response;

class DeleteAction extends Action
{
    /**
     * @var ArticlesProvider $newsProvider
     */
    private $articlesProvider;

    public function __construct($id, ArticlesController $controller, ArticlesProvider $articlesProvider)
    {
        parent::__construct($id, $controller);
        $this->articlesProvider = $articlesProvider;
    }

    public function run(int $id): Response
    {

        if ($this->articlesProvider->deleteArticle($id)) {
            \Yii::$app->session->setFlash('success', 'success');
            return $this->controller->redirect('index');
        }

        \Yii::$app->session->setFlash('error', 'error');

        return $this->controller->redirect('view', ['id' => $id]);
    }
}