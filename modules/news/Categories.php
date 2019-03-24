<?php

namespace app\modules\news;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CategoriesNews $id0
 */
class Categories extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'categories';
    }

    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoriesNews::className(), 'targetAttribute' => ['id' => 'categories_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getId0()
    {
        return $this->hasOne(CategoriesNews::className(), ['categories_id' => 'id']);
    }

    public function getCategoryName()
    {
        return Categories::find()->all();
    }
}
