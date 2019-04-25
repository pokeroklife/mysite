<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use app\modules\blog\behaviors\TagsBehavior;
use app\modules\blog\validators\ModelValidator;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
 *
 */
class Articles extends ActiveRecord
{
    public $articleCreateForm;


    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'tagInsert' => TagsBehavior::class,
            'class' => TimestampBehavior::class,
        ];
    }

    public function rules(): array
    {
        return [
            [['name', 'description', 'text', 'category'], 'required'],
            [['author_id', 'status', 'visits', 'category'], 'integer'],
            [['text'], 'string'],
            [['articleCreateForm'], 'safe'],
            [['name', 'description', 'image'], 'string', 'max' => 255],
//            [
//                ['tags'],
//                'each',
//                'rule' => [
//                    ModelValidator::class,
//                    'modelClass' => Tag::class
//                ]
//            ]

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
            'category' => 'categoriesId',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Categories::class, ['id' => 'category']);
    }

    /**
     * @return Articles[]
     */
    public static function getArticles(): array
    {
        return static::find()->all();
    }

    public static function getArticleCategory(int $id): ActiveRecord
    {
        return static::find()
            ->where(['id' => $id])
            ->with('category')
            ->one();
    }

    public static function getArticle(int $id): ActiveRecord
    {
        return static::find()
            ->where(['id' => $id])
            ->one();
    }

    public static function deleteArticle(int $id): bool
    {
        return (bool)static::deleteAll(['id' => $id]);
    }

    public function getComments(): ActiveQuery
    {
        return $this->hasMany(Comment::class, ['article_id' => 'id']);
    }


    public function getTags(): ActiveQuery
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('article_tag', ['article_id' => 'id']);
    }


    public static function createArticle(ArticleForm $model): ?self
    {
        $article = new self([
            'category' => $model->category,
            'author_id' => $model->authorId,
            'name' => $model->name,
            'description' => $model->description,
            'text' => $model->text,
            'image' => $model->image,
            'status' => $model->status,
        ]);
        $article->articleCreateForm = $model;
        return $article->save() ? $article : null;


    }

    public static function updateArticle($model, $newsId): bool
    {
        $updatedArticle = self::getArticle($newsId);
        $updatedArticle->category = $model->category;
        $updatedArticle->name = $model->name;
        $updatedArticle->description = $model->description;
        $updatedArticle->text = $model->text;
        $updatedArticle->status = $model->status;
        if (isset($model->image)) {
            $updatedArticle->image = $model->image;
        }
        $updatedArticle->articleCreateForm = $model;
        return $updatedArticle->save();
    }


}