<?php
declare(strict_types=1);

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * Class User
 * @package app\models
 */
class User extends ActiveRecord implements IdentityInterface
{
   public const STATUS_DELETED = 0;

   public const STATUS_ACTIVE = 10;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'user';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        $this->on(ActiveRecord::EVENT_AFTER_INSERT, [$this, 'setRole']);

        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'email' => 'Почта',
            'username' => 'Имя пользователя',
            'status' => 'Статус'
        ];
    }

    /**
     * @param int|string $id
     * @return User
     */
    public static function findIdentity($id): self
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return void|IdentityInterface
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @param $username
     * @return User
     */
    public static function findByUsername($username): self
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @param $token
     * @return User
     */
    public static function findByPasswordResetToken($token): self
    {

        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @param $token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {

        if (empty($token)) {
            return false;
        }
        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @return int|mixed|string
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @return string
     */
    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param $password
     * @return bool
     */
    public function validatePassword($password): bool
    {
        return Yii::$app
            ->security
            ->validatePassword($password, $this->password_hash);
    }

    /**
     * @param $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app
            ->security
            ->generatePasswordHash($password);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app
            ->security
            ->generateRandomString();
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app
                ->security
                ->generateRandomString() . '_' . time();
    }

    /**
     *
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @param $email
     * @return User
     */
    public static function findByEmail($email): self
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @throws \Exception
     */
    public function setRole()
    {
        $userRole = Yii::$app
            ->authManager
            ->getRole('user');
        Yii::$app
            ->authManager
            ->assign($userRole, $this->owner->id);
    }

    /**
     * @param SignupForm $model
     * @return User|null
     * @throws \yii\base\Exception
     */
    public static function signUp(SignupForm $model): ?User
    {
        if (!$model->validate()) {
            return null;
        }

        $user = new self(
            [
                'username' => $model->username,
                'email' => $model->email,
            ]
        );
        $user->setPassword($model->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }

}