<?php
declare(strict_types=1);

namespace app\modules\shop\models;

use app\components\DeleteImageBehavior;
use app\modules\shop\behaviors\CategoryBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 */
class Products extends \yii\db\ActiveRecord
{
    public const SCENARIO_CREATE_PRODUCT = 'create';

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'products';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'category_id'], 'required'],
            [['name'], 'string', 'max' => 255],
            [
                'name',
                'unique',
                'targetClass' => self::class,
                'message' => 'Название продукта существует',
                'on' => self::SCENARIO_CREATE_PRODUCT
            ]
        ];
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'class' => TimestampBehavior::class,
            'imageDelete' => DeleteImageBehavior::class,
            'category' => CategoryBehavior::class,
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'category_id' => 'Название категории',
            'name' => 'Название продукта',
        ];
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel(int $id): self
    {
        if (($model = self::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->detail->image ? '/uploads/thumbnail/' . $this->detail->image : '/no-image.png';
    }

    /**
     * @return ActiveQuery
     */
    public function getDetail(): ActiveQuery
    {
        return $this->hasOne(ProductDetail::class, ['product_id' => 'id']);
    }

    public function getAmount(): ActiveQuery
    {
        return $this->hasOne(ProductsAmount::class, ['product_id' => 'id']);
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(ProductsCategory::class, ['id' => 'category_id']);
    }

    public static function getInfo(int $id = null)
    {
        return static::find()
            ->with('category', 'detail', 'amount')
            ->andFilterWhere(['id' => $id])
            ->all();

    }
    public static function findProduct(int $id)
    {
        return static::find()
            ->where(['id' => $id])
            ->with('category', 'detail', 'amount')
            ->one();

    }
}
