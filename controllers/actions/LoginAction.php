<?php

namespace app\controllers\actions;

use app\models\LoginForm;
use Yii;
use yii\base\Action;

class LoginAction extends Action
{

    public function run()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->controller->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->controller->goBack();
        }

        $model->password = '';
        return $this->controller->render('login', [
            'model' => $model,
        ]);
    }
}