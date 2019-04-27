<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\comment;

use app\modules\blog\controllers\CommentController;
use app\modules\blog\providers\CommentsProvider;
use yii\web\Response;

/**
 * Class DeleteAction
 * @package app\modules\blog\controllers\actions\comment
 */
class DeleteAction extends \yii\base\Action
{
    /**
     * @var CommentsProvider
     */
    private $commentsProvider;

    /**
     * DeleteAction constructor.
     * @param $id
     * @param CommentController $controller
     * @param CommentsProvider $commentsProvider
     */
    public function __construct($id, CommentController $controller, CommentsProvider $commentsProvider)
    {
        parent::__construct($id, $controller);
        $this->commentsProvider = $commentsProvider;
    }

    /**
     * @param int $commentId
     * @param int $newsId
     * @return Response
     */
    public function run(int $commentId, int $newsId): Response
    {
        if ($this->commentsProvider->deleteComment($commentId)) {
            \Yii::$app->session->setFlash('success', 'success');

            return $this->controller->redirect(['./articles/view', 'id' => $newsId]);
        }

        \Yii::$app->session->setFlash('error', 'error');

        return $this->controller->redirect(['./articles/view', 'id' => $newsId]);
    }
}