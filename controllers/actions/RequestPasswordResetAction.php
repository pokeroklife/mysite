<?php
/**
 * Created by PhpStorm.
 * User: Романенко
 * Date: 24.03.2019
 * Time: 21:23
 */

namespace app\controllers\actions;

use Yii;
use app\models\PasswordResetRequestForm;
use yii\base\Action;

class RequestPasswordResetAction extends Action
{
    public function run()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate(['email'])) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->controller->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->controller->render('passwordResetRequestForm', [
            'model' => $model,
        ]);
    }
}