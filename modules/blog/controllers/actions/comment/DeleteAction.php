<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\comment;

use app\modules\blog\controllers\CommentController;
use app\modules\blog\providers\CommentsProvider;
use yii\web\Response;

class DeleteAction extends \yii\base\Action
{
    /**
     * @var CommentsProvider $categoriesProvider
     */
    private $commentsProvider;

    public function __construct($id, CommentController $controller, CommentsProvider $commentsProvider)
    {
        parent::__construct($id, $controller);
        $this->commentsProvider = $commentsProvider;
    }

    public function run(int $commentId, int $newsId): Response
    {
        if ($this->commentsProvider->deleteComment($commentId)) {
            \Yii::$app->session->setFlash('success', 'success');

            return $this->controller->redirect(['./news/view', 'id' => $newsId]);
        }

        \Yii::$app->session->setFlash('error', 'error');

        return $this->controller->redirect(['./news/view', 'id' => $newsId]);
    }
}