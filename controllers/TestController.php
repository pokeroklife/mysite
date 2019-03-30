<?php
/**
 * Created by PhpStorm.
 * User: Романенко
 * Date: 29.03.2019
 * Time: 08:43
 */

namespace app\controllers;


use yii\base\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCatalog()
    {
        return $this->render('catalog');
    }

    public function actionContact()
    {
        return $this->render('contact');
    }

    public function actionItem()
    {
        return $this->render('item');
    }
}