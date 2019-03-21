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
        $test = new Test();
//        $test->on(Test::TEST_BEGIN, function($event){
//            var_dump($event->name);
//        });
//        $test->on(Test::TEST_BEGIN, ['app\models\Test', 'd']);
//        $test->on(Test::TEST_BEGIN, [$test, 'd']);
//        $test->trigger(Test::TEST_BEGIN);
        $test->role();
        die;
    }
}