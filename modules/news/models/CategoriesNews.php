<?php

namespace app\modules\news\models;

use app\modules\news\News;
use Yii;

/**
 * This is the model class for table "categories_news".
 *
 * @property int $categories_id
 * @property int $news_id
 *
 * @property News $news
 */
class CategoriesNews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories_news';
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
            [['categories_id', 'news_id'], 'required'],
            [['categories_id', 'news_id'], 'integer'],
            [['categories_id', 'news_id'], 'unique', 'targetAttribute' => ['categories_id', 'news_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'categories_id' => 'CategoriesNews ID',
            'news_id' => 'News ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::class, ['id' => 'news_id']);
    }


}
