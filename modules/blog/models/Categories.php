<?php
declare(strict_types=1);

namespace app\modules\blog\models;


/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriesNews(): object
    {
        return $this->hasMany(News::class, ['categories_id' => 'id']);
    }

    /**
     * @return Categories[]
     */
    public static function getCategories(): array
    {
        return static::find()->select(['id', 'name'])->all();
    }

    public static function deleteCategory(int $id): bool
    {
        return (bool)static::deleteAll($id);
    }
}


