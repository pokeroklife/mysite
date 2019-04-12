<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\controllers\NewsController;
use app\modules\blog\providers\NewsProvider;
use app\modules\blog\providers\TagsProvider;
use yii\base\Action;

class IndexAction extends Action
{
    /**
     * @var NewsProvider $newsProvider
     */
    private $newsProvider;
    private $tagsProvider;

    public function __construct(
        $id,
        NewsController $controller,
        NewsProvider $newsProvider,
        TagsProvider $tagsProvider
    ) {
        parent::__construct($id, $controller);
        $this->newsProvider = $newsProvider;
        $this->tagsProvider = $tagsProvider;
    }

    public function run(int $tagId = null): string
    {
        if ($tagId === null) {
            $models = $this->newsProvider->getNews();
            $tags = $this->tagsProvider->getTags();
            return $this->controller->render('index', compact('models', 'tags'));
        } else {
            $models = $this->tagsProvider->getNewsWithTag($tagId);
            return $this->controller->render('index', compact('models'));
        }
    }
}