<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lang".
 *
 * @property int $id
 * @property string $url
 * @property string $local
 * @property string $name
 * @property int $default
 * @property int $date_update
 * @property int $date_create
 * Class Lang
 * @package app\models
 */
class Lang extends \yii\db\ActiveRecord
{
    /**
     * @var
     */
    public static $current;

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'lang';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['url', 'local', 'name'], 'required'],
            [['default'], 'integer'],
            [['url', 'local', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'local' => 'Local',
            'name' => 'Name',
            'default' => 'Default',
        ];
    }

    /**
     * @return array|\yii\db\ActiveRecord|null
     */
    public static function getCurrent(): ?ActiveRecord
    {
        if (self::$current === null) {
            self::$current = self::getDefaultLang();
        }
        return self::$current;
    }


    /**
     * @param string|null $url
     */
    public static function setCurrent(string $url = null): void
    {
        $language = self::getLangByUrl($url);
        self::$current = $language ?? self::getDefaultLang();
        Yii::$app->language = self::$current->local;
    }

    /**
     * @return array|\yii\db\ActiveRecord|null
     */
    public static function getDefaultLang(): ?ActiveRecord
    {
        return self::find()->where('`default` = :default', [':default' => 1])->one();
    }

    /**
     * @param null $url
     * @return array|\yii\db\ActiveRecord|null
     */
    public static function getLangByUrl($url = null): ?ActiveRecord
    {
        if ($url === null) {
            return null;
        }
        $language = self::find()->where('url = :url', [':url' => $url])->one();
        if ($language === null) {
            return null;
        }
        return $language;


    }
}
