<?php
declare(strict_types=1);

namespace app\controllers\actions;

use Yii;

use app\models\ResetPasswordForm;
use yii\base\Action;

/**
 * Class ResetPasswordAction
 * @package app\controllers\actions
 */
class ResetPasswordAction extends Action
{
    /**
     * @param $token
     * @return string
     */
    public function run($token): string
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (\InvalidArgumentException $exception) {
            \Yii::$app->session->setFlash('success', $exception->getMessage());
            return $this->controller->render('index');
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->controller->render('index');
        }

        return $this->controller->render('resetPassword', [
            'model' => $model,
        ]);
    }
}