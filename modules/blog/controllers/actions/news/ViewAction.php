<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\models\CommentForm;
use app\modules\blog\providers\CommentsProvider;
use app\modules\blog\providers\NewsProvider;
use app\modules\blog\controllers\NewsController;
use yii\base\Action;

class ViewAction extends Action
{
    private $newsProvider;
    private $commentProvider;

    public function __construct(
        $id,
        NewsController $controller,
        NewsProvider $newsProvider,
        CommentsProvider $commentProvider
    ) {
        parent::__construct($id, $controller);
        $this->newsProvider = $newsProvider;
        $this->commentProvider = $commentProvider;
    }

    public function run(int $id): string
    {

        $model = $this->newsProvider->getArticleCategory($id);
        $comments = $this->commentProvider->getComment($id);
        $tags = $this->newsProvider->getArticleTags($id);
        $commentForm = new CommentForm();
        \Yii::$app->session->set('newsId', $id);
        return $this->controller->render('view',
            compact('model', 'comments', 'commentForm', 'tags'));
    }
}