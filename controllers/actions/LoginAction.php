<?php
declare(strict_types=1);

namespace app\controllers\actions;

use app\models\LoginForm;
use Yii;
use yii\base\Action;

class LoginAction extends Action
{

    public function run(): string
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->controller->render('index');
        }
        $model->password = '';
        return $this->controller->render('login', [
            'model' => $model,
        ]);
    }
}