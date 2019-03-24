<?php

namespace app\modules\news\controllers;

use app\modules\news\Categories;
use yii\base\Component;
use yii\web\Controller;


class NewsController extends Controller
{
    public $layout = 'myLayout';
    public function actionIndex()
    {
        $model = new Categories();
        $categories = $model->getCategoryName();

        return $this->render('index', compact('categories'));
    }
}
