<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\controllers\ArticlesController;
use app\modules\blog\providers\ArticlesProvider;
use app\modules\blog\providers\TagsProvider;
use yii\base\Action;

/**
 * Class IndexAction
 * @package app\modules\blog\controllers\actions\news
 */
class IndexAction extends Action
{
    /**
     * @var ArticlesProvider
     */
    private $articlesProvider;
    /**
     * @var TagsProvider
     */
    private $tagsProvider;

    /**
     * IndexAction constructor.
     * @param $id
     * @param ArticlesController $controller
     * @param ArticlesProvider $articlesProvider
     * @param TagsProvider $tagsProvider
     */
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

    /**
     * @param int|null $tagId
     * @return string
     */
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