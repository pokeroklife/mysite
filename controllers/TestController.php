<?php
/**
 * Created by PhpStorm.
 * User: Романенко
 * Date: 18.03.2019
 * Time: 14:04
 */

namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionTest()
    {
        $user = new User();
        if (Yii::$app->request->isPost) {
            $user ->load(Yii::$app->request->post());
        }

        return $this->render('test', [
            'user' => $user
        ]);
    }
}