<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\models\CommentForm;
use app\modules\blog\providers\CommentsProvider;
use app\modules\blog\providers\ArticlesProvider;
use app\modules\blog\controllers\ArticlesController;
use yii\base\Action;

class ViewAction extends Action
{
    private $articlesProvider;
    private $commentProvider;

    public function __construct(
        $id,
        ArticlesController $controller,
        ArticlesProvider $articlesProvider,
        CommentsProvider $commentProvider
    ) {
        parent::__construct($id, $controller);
        $this->articlesProvider = $articlesProvider;
        $this->commentProvider = $commentProvider;
    }

    public function run(int $id): string
    {

        $model = $this->articlesProvider->getArticleCategory($id);
        $comments = $this->commentProvider->getComment($id);
        $tags = $this->articlesProvider->getArticleTags($id);
        var_dump($tags);die;
        $commentForm = new CommentForm();
        \Yii::$app->session->set('newsId', $id);
        return $this->controller->render('view',
            compact('model', 'comments', 'commentForm', 'tags'));
    }
}