<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\controllers\ArticlesController;
use app\modules\blog\models\Articles;
use app\modules\blog\providers\ArticlesProvider;
use app\modules\shop\models\Products;
use yii\base\Action;
use yii\web\Response;

/**
 * Class DeleteAction
 * @package app\modules\blog\controllers\actions\news
 */
class DeleteAction extends Action
{
    /**
     * @var ArticlesProvider
     */
    private $articlesProvider;

    /**
     * DeleteAction constructor.
     * @param $id
     * @param ArticlesController $controller
     * @param ArticlesProvider $articlesProvider
     */
    public function __construct($id, ArticlesController $controller, ArticlesProvider $articlesProvider)
    {
        parent::__construct($id, $controller);
        $this->articlesProvider = $articlesProvider;
    }

    /**
     * @param int $id
     * @return Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\NotFoundHttpException
     */
    public function run(int $id): Response
    {
        $model = Articles::findModel($id);

        if ($model->delete()) {
            \Yii::$app->session->setFlash('success', 'success');
            return $this->controller->redirect('index');
        }

        \Yii::$app->session->setFlash('error', 'error');

        return $this->controller->redirect('view', ['id' => $id]);
    }
}