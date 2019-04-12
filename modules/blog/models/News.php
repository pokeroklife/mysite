<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int $author_id
 * @property int $categories_id
 * @property string $name
 * @property string $description
 * @property string $text
 * @property string $image
 * @property int $status
 * @property int $visits
 * @property int $created_at
 * @property int $updated_at
 *
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'news';
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
            [['name', 'description', 'text', 'categories_id'], 'required'],
            [['author_id', 'status', 'visits', 'categories_id'], 'integer'],
            [['text'], 'string'],
            [['name', 'description', 'image'], 'string', 'max' => 255],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'name' => 'Name',
            'description' => 'Short Description',
            'text' => 'Text',
            'image' => 'Upload Image',
            'status' => 'Status',
            'visits' => 'Visits',
            'categories_id' => 'categoriesId',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Categories::class, ['id' => 'categories_id']);
    }

    /**
     * @return News[]
     */
    public static function getNews(): array
    {
        return static::find()->all();
    }

    public static function getArticle(int $id): ActiveRecord
    {
        return static::find()
            ->where(['id' => $id])
            ->with('category')
            ->one();
    }

    public static function deleteArticle(int $id): bool
    {
        return (bool)static::deleteAll(['id' => $id]);
    }

    public function getComment(): ActiveQuery
    {
        return $this->hasMany(Comment::class, ['news_id' => 'id']);
    }

    public function getTag(): ActiveQuery
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->viaTable('news_tag', ['news_id' => 'id']);
    }


}