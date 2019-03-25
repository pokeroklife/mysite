<?php

namespace app\controllers\actions;


use app\models\SignupForm;
use yii\base\Action;

class SignupAction extends Action
{
    public function run()
    {
        $model = new SignupForm();

        if (
            $model->load(\Yii::$app->request->post())
            && ($user = $model->signup())
            && \Yii::$app->getUser()->login($user)
        ) {
            return $this->controller->goHome();
        }

        return $this->controller->render('signup', [
            'model' => $model,
        ]);
    }
}
