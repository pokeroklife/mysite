<?php
declare(strict_types=1);

namespace app\controllers\actions;

use app\models\LoginForm;
use Yii;
use yii\base\Action;

/**
 * Class LoginAction
 * @package app\controllers\actions
 */
class LoginAction extends Action
{
    /**
     * @return string
     */
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