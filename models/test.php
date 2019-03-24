<?php


namespace app\models;


use yii\base\Model;

class Test extends Model
{
    const TEST_BEGIN = 'test begin';

    public function init()
    {
        $this->on(Test::TEST_BEGIN, ['app\models\Test', 'd']);
    }


    public function d()
    {

        var_dump('ddd');
    }

    public  function role()
    {

        $this->trigger(Test::TEST_BEGIN);
    }
}