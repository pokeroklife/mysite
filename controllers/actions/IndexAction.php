<?php
declare(strict_types=1);

namespace app\controllers\actions;


use yii\base\Action;

class IndexAction extends Action
{
    public $view;

    public function run(): string
    {
        return $this->controller->render('index');
    }
}