<?php

namespace app\modules\news\controllers\actions;


use app\modules\news\controllers\NewsController;
use app\modules\news\providers\CategoryProvider;
use yii\base\Action;

class IndexAction extends Action
{
    private $categoryProvider;

    public function __construct($id, NewsController $module, CategoryProvider $categoryProvider)
    {
        /**
         * @var CategoryProvider $newsProvider
         */

        parent::__construct($id, $module);
        $this->categoryProvider = $categoryProvider;
    }

    public function run()
    {
        $categories = $this->categoryProvider->getCategoryName();


        return $this->controller->render('index', compact('categories'));
    }
}