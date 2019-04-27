<?php
declare(strict_types=1);

namespace app\modules\admin;

/**
 * Class Admin
 * @package app\modules\admin
 */
class Admin extends \yii\base\Module
{
    /**
     * @var string
     */
    public $controllerNamespace = 'app\modules\admin\controllers';


    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
