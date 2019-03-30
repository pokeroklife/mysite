<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $username;
    public $email;
    public $password;
    public $id;
//    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules():array
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            [
                'username',
                'unique',
                'targetClass' => '\app\models\User',
                'message' => 'This username has already been taken.'
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email',
                'unique',
                'targetClass' => '\app\models\User',
                'message' => 'This email address has already been taken.'
            ],
            ['password', 'required'],
            ['password', 'string', 'min' => 2],
//            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels():array
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    public function signup():object
    {

        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }

}