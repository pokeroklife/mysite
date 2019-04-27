<?php
declare(strict_types=1);

namespace app\controllers\actions;


use yii\base\Action;

/**
 * Class IndexAction
 * @package app\controllers\actions
 */
class IndexAction extends Action
{
    /**
     * @var
     */
    public $view;

    /**
     * @return string
     */
    public function run(): string
    {
        return $this->controller->render('index');
    }
}