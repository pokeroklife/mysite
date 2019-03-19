<?php
/**
 * Created by PhpStorm.
 * User: Романенко
 * Date: 18.03.2019
 * Time: 16:13
 */

namespace app\widgets;


use yii\base\Widget;

class myWidgets extends Widget
{
    public $message = 'Hello World';
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->message;
    }
}