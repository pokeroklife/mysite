<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use yii\db\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article_tag".
 *
 * @property int $article_id
 * @property int $tag_id
 * @property string $created_at
 *
 * @property Articles $news
 * @property Tag $tag
 */
class ArticlesTag extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'article_tag';
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
            [['article_id', 'tag_id'], 'required'],
            [['article_id', 'tag_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'article_id' => 'News ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * @param Tag[] $tags
     * @param  int $articleId
     * @return void
     * @throws Exception
     */
    public static function createRelationArticleTags(array $tags, int $articleId): void
    {
        foreach ($tags as $tag) {
            $relation = new self();
            $relation->article_id = $articleId;
            $relation->tag_id = $tag->id;
            if ($relation->save() === false) {
                throw new Exception('привязка тэга к новости не сохранилась');
            }
        }
    }

    public static function deleteArticleTags(int $articleId): void
    {
        static::deleteAll(['article_id' => $articleId]);
    }
}
