<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "news_tag".
 *
 * @property int $news_id
 * @property int $tag_id
 * @property string $created_at
 *
 * @property News $news
 * @property Tag $tag
 */
class NewsTag extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'news_tag';
    }

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
            ],

        ];
    }

    public function rules(): array
    {
        return [
            [['news_id', 'tag_id'], 'required'],
            [['news_id', 'tag_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'news_id' => 'News ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * @param Tag[] $tags
     * @param  int $newsId
     * @return void
     */
    public static function createRelationArticleTags(array $tags, int $newsId): void
    {

        foreach ($tags as $tag) {
            $relation = new self();
            $relation->news_id = $newsId;
            $relation->tag_id = $tag->id;
            if ($relation->save() === false) {
                throw new Exception('error');
            }
        }
    }

    public static function deleteArticleTags(int $newsId): bool
    {
        return (bool)static::deleteAll(['news_id' => $newsId]);
    }
}
