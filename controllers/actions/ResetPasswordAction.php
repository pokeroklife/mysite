<?php
/**
 * Created by PhpStorm.
 * User: Романенко
 * Date: 24.03.2019
 * Time: 21:23
 */

namespace app\controllers\actions;
use Yii;

use app\models\ResetPasswordForm;
use yii\base\Action;

class ResetPasswordAction extends Action
{
    public function run($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (\InvalidArgumentException $exception) {
            \Yii::$app->session->setFlash('success', $exception->getMessage());
            return $this->controller->goHome();
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->controller->goHome();
        }

        return $this->controller->render('resetPassword', [
            'model' => $model,
        ]);
    }
}