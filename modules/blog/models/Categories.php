<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property Articles[] $categoriesArticles
 * Class Categories
 * @package app\modules\blog\models
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'categories';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'class' => TimestampBehavior::class,
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
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
     * @return ActiveQuery
     */
    public function getCategoriesArticles(): ActiveQuery
    {
        return $this->hasMany(Articles::class, ['category' => 'id']);
    }

    /**
     * @return array
     */
    public static function getCategories(): array
    {
        return static::find()->select(['id', 'name'])->all();

    }

    /**
     * @param int $id
     * @return bool
     */
    public static function deleteCategory(int $id): bool
    {
        return (bool)static::deleteAll(['id' => $id]);
    }

    /**
     * @param CategoriesCreateForm $model
     * @return bool
     */
    public static function createCategory(CategoriesCreateForm $model): bool
    {
        $category = new self();
        $category->name = $model->name;
        $category->status = $model->status;
        return $category->save();
    }
}


