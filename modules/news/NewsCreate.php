<?php

namespace app\modules\news;

use Yii;

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
class NewsCreate extends \yii\db\ActiveRecord
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
    public function rules()
    {
        return [
            [['author_id', 'name', 'short_description', 'text', 'visits', 'created_at', 'updated_at'], 'required'],
            [['author_id', 'status', 'visits', 'created_at', 'updated_at'], 'integer'],
            [['text'], 'string'],
            [['name', 'short_description'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoriesNews::className(), 'targetAttribute' => ['id' => 'news_id']],
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
            'status' => 'Status',
            'visits' => 'Visits',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(CategoriesNews::className(), ['news_id' => 'id']);
    }
}
