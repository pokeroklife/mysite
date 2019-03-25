<?php

namespace app\modules\news\controllers;

use app\modules\news\Categories;
use app\modules\news\providers\NewsProvider;
use yii\base\Module;
use yii\web\Controller;
use app\modules\news\NewsCreate;

class NewsController extends Controller
{
    /**
     * @var NewsProvider $newsProvider
     */
    private $newsProvider;

    public function __construct($id, Module $module, NewsProvider $newsProvider)
    {
        parent::__construct($id, $module);
        $this->newsProvider = $newsProvider;
    }

    public function actionIndex()
    {
        $categories = $this->newsProvider->getCategoryName();

        return $this->render('index', compact('categories'));
    }

    public function actionWorld()
    {
        return $this->render('world');
    }

    public function actionUkraine()
    {
        return $this->render('ukraine');
    }

    public function actionCreator()
    {
        $news = new NewsCreate();
        return $this->render('CategoryNewsCreate');
    }
}
