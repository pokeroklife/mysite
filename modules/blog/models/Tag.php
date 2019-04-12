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
 * @property NewsTag[] $newsTags
 * @property News[] $news
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
    public function getTagsNews(): ActiveQuery
    {
        return $this->hasMany(News::class, ['id' => 'news_id'])->viaTable('news_tag', ['tag_id' => 'id']);
    }

    public static function getTags(): array
    {
        return static::find()->select(['id', 'name'])->where(['status' => 1])->all();
    }

    public static function createTag(TagsCreateForm $model): bool
    {
        $tag = new Tag();
        $tag->name = $model->name;
        $tag->status = $model->status;
        return $tag->save();
    }
}
