<?php

namespace app\modules\news\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property int $created_at
 * @property int $updated_at
 *
 * @property News $id0
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
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
            [['username', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
            [['email'], 'email'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['id' => 'author_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'Почта',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(News::className(), ['author_id' => 'id']);
    }
}
