<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
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
            [['news_id', 'tag_id'], 'unique', 'targetAttribute' => ['news_id', 'tag_id']],
            [
                ['news_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => News::class,
                'targetAttribute' => ['news_id' => 'id']
            ],
            [
                ['tag_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Tag::class,
                'targetAttribute' => ['tag_id' => 'id']
            ],
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
     * @return \yii\db\ActiveQuery
     */
    public function getNews(): ActiveQuery
    {
        return $this->hasOne(News::class, ['id' => 'news_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag(): ActiveQuery
    {
        return $this->hasOne(Tag::class, ['id' => 'tag_id']);
    }

    public static function createRelationArticleTags(NewsCreateForm $model, News $news): bool
    {
        foreach ($model->tags as $tag) {
            $relation = new NewsTag();
            $relation->news_id = $news->id;
            $relation->tag_id = $tag;
            $result = $relation->save();
            if ($result === false) {
                return false;
            }
        }
        return true;
    }
}
