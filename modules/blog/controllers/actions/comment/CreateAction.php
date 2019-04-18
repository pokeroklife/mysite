<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\comment;

use app\modules\blog\controllers\CommentController;
use app\modules\blog\models\CommentForm;
use app\modules\blog\providers\CommentsProvider;
use yii\web\Response;

class CreateAction extends \yii\base\Action
{
    private $commentProvider;

    public function __construct(
        $id,
        CommentController $controller,
        CommentsProvider $commentProvider
    ) {
        parent::__construct($id, $controller);
        $this->commentProvider = $commentProvider;
    }

    public function run(): Response
    {
        $comment = new CommentForm();
        $comment->username = \Yii::$app->getUser()->identity->username;
        $comment->newsId = \Yii::$app->session->get('newsId');
        if ($comment->load(\Yii::$app->request->post()) &&
            $this->commentProvider->createComment($comment)) {

        }return $this->controller->redirect(['news/view', 'id' => $comment->newsId]);
    }
}