<?php
declare(strict_types=1);

namespace app\controllers\actions;

use app\models\SignupForm;
use app\models\User;
use yii\base\Action;

class SignupAction extends Action
{
    public function run(): string
    {
        $model = new SignupForm();

        if (
            $model->load(\Yii::$app->request->post())
            && ($user = User::signUp($model))
            && \Yii::$app->getUser()->login($user)
        ) {
            return $this->controller->render('index');
        }

        return $this->controller->render('signup', [
            'model' => $model,
        ]);
    }
}
