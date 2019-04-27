<?php
declare(strict_types=1);

namespace app\controllers\actions;

use Yii;
use app\models\PasswordResetRequestForm;
use yii\base\Action;

/**
 * Class RequestPasswordResetAction
 * @package app\controllers\actions
 */
class RequestPasswordResetAction extends Action
{
    /**
     * @return string
     */
    public function run(): string
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate(['email'])) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->controller->render('index');
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->controller->render('passwordResetRequestForm', [
            'model' => $model,
        ]);
    }
}