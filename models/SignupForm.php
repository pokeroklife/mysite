<?php
declare(strict_types=1);

namespace app\models;

use yii\base\Model;

/**
 * Class SignupForm
 * @package app\models
 */
class SignupForm extends Model
{
    /**
     * @var
     */
    public $username;
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */
    public $password;
    /**
     * @var
     */
    public $id;
    /**
     * @var
     */
    public $verifyCode;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            [
                'username',
                'unique',
                'targetClass' => User::class,
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
                'targetClass' => User::class,
                'message' => 'This email address has already been taken.'
            ],
            ['password', 'required'],
            ['password', 'string', 'min' => 2],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

}