<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use app\components\DeleteImageBehavior;
use app\modules\blog\behaviors\TagsBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property int $author_id
 * @property int $category
 * @property string $name
 * @property string $description
 * @property string $text
 * @property string $image
 * @property int $status
 * @property int $visits
 * @property int $created_at
 * @property int $updated_at
 * @property Tag[] $tags
 * Class Articles
 * @package app\modules\blog\models
 */
class Articles extends ActiveRecord
{
    /**
     * @var
     */
    public $tag;

    public const SCENARIO_CREATE_ARTICLE = 'create';

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'articles';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'tagInsert' => TagsBehavior::class,
            'class' => TimestampBehavior::class,
            'imageDelete' => DeleteImageBehavior::class,
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'description', 'text', 'category'], 'required'],
            [['tag'], 'required'],
            [['image'], 'required', 'message' => 'Картинка отсутствует', 'on' => self::SCENARIO_CREATE_ARTICLE],
            [['author_id', 'status', 'visits', 'category'], 'integer'],
            [['text'], 'string'],
            [['articleCreateForm'], 'safe'],
            [['name', 'description', 'image'], 'string', 'max' => 255],
            [
                'name',
                'unique',
                'targetClass' => self::class,
                'message' => 'Эта новость уже существует',
                'on' => self::SCENARIO_CREATE_ARTICLE
            ],


        ];
    }

    /**
     * @return array
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
            'category' => 'categoriesId',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Categories::class, ['id' => 'category']);
    }

    /**
     * @return array
     */
    public static function getArticles(): array
    {
        return static::find()->all();
    }

    /**
     * @param int $id
     * @return ActiveRecord
     */
    public static function getArticleCategoryTags(int $id): ActiveRecord
    {
        return static::find()
            ->where(['id' => $id])
            ->with('category', 'tags')
            ->one();
    }

    /**
     * @param int $id
     * @return ActiveRecord
     */
    public static function getArticleTags(int $id): ActiveRecord
    {
        return static::find()
            ->where(['id' => $id])
            ->with('tags')
            ->one();
    }

    /**
     * @param int $id
     * @return Articles
     * @throws NotFoundHttpException
     */
    public static function findModel(int $id): self
    {
        if (($model = self::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return ActiveQuery
     */
    public function getComments(): ActiveQuery
    {
        return $this->hasMany(Comment::class, ['article_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getTags(): ActiveQuery
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('article_tag', ['article_id' => 'id']);
    }
}