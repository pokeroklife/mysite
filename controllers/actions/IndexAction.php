<?php
namespace app\controllers\actions;

use Yii;
use yii\base\Action;

class IndexAction extends Action
{
    public $view;
    public function run()
    {
        return $this->controller->render('index');
    }
}