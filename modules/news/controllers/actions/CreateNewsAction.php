<?php

namespace app\modules\news\controllers\actions;


use Yii;
use app\modules\news\models\NewsCreateForm;
use yii\base\Action;

class CreateNewsAction extends Action
{
    public function run()
    {
        $model = new NewsCreateForm();
        if ($model->load(Yii::$app->request->post()) && $model->saveNews()) {
            Yii::$app->session->setFlash('success', 'Статья сохранена');
            return $this->controller->render('createNews', compact('model'));
        }

        return $this->controller->render('createNews', compact('model'));
    }
}