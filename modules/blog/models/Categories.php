<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use yii\behaviors\TimestampBehavior;

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
    public function behaviors(): array
    {
        return [
            'class' => TimestampBehavior::class,
        ];
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
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
            'name' => 'Имя Категории',
            'status' => 'Статус',
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
        return (bool)static::deleteAll(['id' => $id]);
    }

    public static function createCategory(CategoriesCreateForm $model): bool
    {
        $category = new Categories();
        $category->name = $model->name;
        $category->status = $model->status;
        return $category->save();
    }
}


