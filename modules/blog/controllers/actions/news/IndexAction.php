<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\controllers\NewsController;
use app\modules\blog\providers\NewsProvider;
use yii\base\Action;

class IndexAction extends Action
{
    /**
     * @var NewsProvider $newsProvider
     */
    private $newsProvider;

    public function __construct(
        $id,
        NewsController $controller,
        NewsProvider $newsProvider
    ) {
        parent::__construct($id, $controller);
        $this->newsProvider = $newsProvider;
    }

    public function run(): string
    {
        $models = $this->newsProvider->getNews();

        return $this->controller->render('index', compact('models'));
    }
}