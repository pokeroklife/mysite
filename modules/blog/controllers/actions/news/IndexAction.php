<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\controllers\ArticlesController;
use app\modules\blog\providers\ArticlesProvider;
use app\modules\blog\providers\TagsProvider;
use yii\base\Action;

class IndexAction extends Action
{
    /**
     * @var ArticlesProvider $newsProvider
     */
    private $articlesProvider;
    private $tagsProvider;

    public function __construct(
        $id,
        ArticlesController $controller,
        ArticlesProvider $articlesProvider,
        TagsProvider $tagsProvider
    ) {
        parent::__construct($id, $controller);
        $this->articlesProvider = $articlesProvider;
        $this->tagsProvider = $tagsProvider;
    }

    public function run(int $tagId = null): string
    {
        if ($tagId === null) {
            $models = $this->articlesProvider->getArticles();
            $tags = $this->tagsProvider->getTags();
            return $this->controller->render('index', compact('models', 'tags'));
        }
            $models = $this->tagsProvider->getArticleWithTag($tagId);
            return $this->controller->render('index', compact('models'));

    }
}