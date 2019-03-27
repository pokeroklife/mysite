<?php

namespace app\modules\news\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int $author_id
 * @property string $name
 * @property string $short_description
 * @property string $text
 * @property int $status
 * @property int $visits
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Author $author
 * @property CategoriesNews $id0
 */
class NewsCreate extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
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

    public function rules(): array
    {
        return [
            [['author_id', 'name', 'short_description', 'text'], 'required'],
            [['author_id', 'status'], 'integer'],
            [['text'], 'string'],
            [['name', 'short_description'], 'string', 'max' => 255],

            [
                ['id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => CategoriesNews::class,
                'targetAttribute' => ['id' => 'news_id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'author_id' => 'Author ID',
            'name' => 'Name',
            'short_description' => 'Short Description',
            'text' => 'Text',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(CategoriesNews::class, ['news_id' => 'id']);
    }

    public function getNews()
    {
        return $this->find()->all();
    }


}
