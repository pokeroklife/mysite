<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\providers\NewsProvider;
use app\modules\blog\controllers\NewsController;
use yii\base\Action;

class ViewAction extends Action
{
    private $NewsProvider;

    public function __construct(
        $id,
        NewsController $controller,
        NewsProvider $NewsProvider
    ) {
        parent::__construct($id, $controller);
        $this->NewsProvider = $NewsProvider;
    }

    public function run(int $id): string
    {
        $model = $this->NewsProvider->getArticle($id);

        return $this->controller->render('view', compact('model'));
    }
}