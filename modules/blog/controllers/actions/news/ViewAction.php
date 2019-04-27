<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\models\CommentForm;
use app\modules\blog\providers\CommentsProvider;
use app\modules\blog\providers\ArticlesProvider;
use app\modules\blog\controllers\ArticlesController;
use yii\base\Action;

/**
 * Class ViewAction
 * @package app\modules\blog\controllers\actions\news
 */
class ViewAction extends Action
{
    /**
     * @var ArticlesProvider
     */
    private $articlesProvider;
    /**
     * @var CommentsProvider
     */
    private $commentProvider;

    /**
     * ViewAction constructor.
     * @param $id
     * @param ArticlesController $controller
     * @param ArticlesProvider $articlesProvider
     * @param CommentsProvider $commentProvider
     */
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

    /**
     * @param int $id
     * @return string
     */
    public function run(int $id): string
    {

        $model = $this->articlesProvider->getArticleCategoryTags($id);
        $comments = $this->commentProvider->getComment($id);
        $commentForm = new CommentForm();
        \Yii::$app->session->set('newsId', $id);
        return $this->controller->render('view',
            compact('model', 'comments', 'commentForm'));
    }
}