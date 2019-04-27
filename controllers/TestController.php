<?php
declare(strict_types=1);

namespace app\controllers;

use yii\base\Controller;

/**
 * Class TestController
 * @package app\controllers
 */
class TestController extends Controller
{
    /**
     * @var string
     */
    public $layout = 'myLayout';

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * @return string
     */

    public function actionCatalog(): string
    {
        return $this->render('catalog');
    }

    /**
     * @return string
     */
    public function actionContact(): string
    {
        return $this->render('contact');
    }

    /**
     * @return string
     */
    public function actionItem(): string
    {
        return $this->render('item');
    }
}