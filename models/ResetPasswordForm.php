<?php
declare(strict_types=1);

namespace app\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;

/**
 * Class ResetPasswordForm
 * @package app\models
 */
class ResetPasswordForm extends Model
{
    /**
     * @var
     */
    public $password;

    /**
     * @var \app\models\User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }

        $this->_user = User::findByPasswordResetToken($token);

        if (!$this->_user) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }

        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * @return bool
     */
    public function resetPassword(): bool
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save(false);
    }

}