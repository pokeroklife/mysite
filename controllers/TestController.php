<?php
/**
 * Created by PhpStorm.
 * User: Романенко
 * Date: 18.03.2019
 * Time: 14:04
 */

namespace app\controllers;

use Yii;
use app\models\Test;
use yii\web\Controller;

class TestController extends Controller
{

    public function actionTest()
    {
        return $this->render('test');
    }
}