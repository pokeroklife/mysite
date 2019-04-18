<?php
declare(strict_types=1);

namespace app\controllers;

use yii\base\Controller;

class TestController extends Controller
{
    public $layout = 'myLayout';

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionCatalog(): string
    {
        return $this->render('catalog');
    }

    public function actionContact(): string
    {
        return $this->render('contact');
    }

    public function actionItem(): string
    {
        return $this->render('item');
    }
}