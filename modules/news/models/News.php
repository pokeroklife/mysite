<?php

namespace app\modules\news\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int $author_id
 * @property int $categories_id
 * @property string $name
 * @property string $short_description
 * @property string $text
 * @property string $upload_image
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
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
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

    public function rules()
    {
        return [
            [['name', 'short_description', 'text', 'categories_id'], 'required'],
            [['author_id', 'status', 'visits', 'categories_id'], 'integer'],
            [['text'], 'string'],
            [['name', 'short_description', 'upload_image'], 'string', 'max' => 255],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'name' => 'Name',
            'short_description' => 'Short Description',
            'text' => 'Text',
            'upload_image' => 'Upload Image',
            'status' => 'Status',
            'visits' => 'Visits',
            'categories_id' => 'categoriesId',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Categories::class, ['id' => 'categories_id']);
    }

    public static function selectNews($id): array
    {

        if ($id === null) {
            return static::find()->all();
        } else {

            return static::find()->where(['id' => $id])->all();
        }
    }

    public function getCategoryNews($category)
    {
        return static::find()->where(['categories_id' => $category])->all();
    }
}

