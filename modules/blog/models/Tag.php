<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ArticlesTag[] $newsTags
 * @property Articles[] $news
 */
class Tag extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'class' => TimestampBehavior::class,
        ];
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagsArticles(): ActiveQuery
    {
        return $this->hasMany(Articles::class, ['id' => 'article_id'])
            ->viaTable('article_tag', ['tag_id' => 'id']);
    }

    public static function getTags(array $tags = []): array
    {
        return static::find()
            ->select(['id', 'name'])
            ->where(['status' => 1])
            ->andFilterWhere(['name' => $tags])
            ->all();
    }

    public static function getTagsArticle(): array
    {
        return static::find()->select(['id', 'name'])
            ->where(['status' => 1])
            ->all();
    }

    public static function getTagsName(): array
    {
        return static::find()->select(['name'])
            ->where(['status' => 1])
            ->all();
    }


    public static function createTag(string $name): ?self
    {
        $tags = new self();
        $tags->name = $name;
        return $tags->save()? $tags : null;
    }


}
