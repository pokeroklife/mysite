<?php

namespace app\components;

use yii\base\Component;


class SetRole extends Component
{
    const SET_ROLE = 'set role of user';


    public function init()
    {
        $this->on(SetRole::SET_ROLE, ['app\components\SetRole', 'setRole']);
    }

    public static function setRole()
    {
        return 'like';
    }
//
//    public function role()
//    {
//        $this->trigger(SetRole::SET_ROLE);
//    }
}