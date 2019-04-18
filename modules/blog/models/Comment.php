<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $username
 * @property int $news_id
 * @property string $comment
 * @property string $created_at
 *
 * @property Comment[] $comments
 */
class Comment extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],

                'value' => new Expression('NOW()'),
            ],

        ];
    }

    public static function tableName(): string
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['username', 'news_id', 'comment'], 'required'],
            [['news_id', 'parent_id'], 'integer'],
            [['comment'], 'string'],
            [['username'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'username' => 'Username',
            'news_id' => 'News ID',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews(): ActiveQuery
    {
        return $this->hasOne(News::class, ['id' => 'news_id']);
    }


    public static function getComment(int $id): array
    {
        return static::find()
            ->where(['news_id' => $id])
            ->orderBy('created_at')
            ->asArray()
            ->all();
    }

    public static function deleteComment(int $id): bool
    {
        return (bool)static::deleteAll(['id' => $id]);
    }
}
