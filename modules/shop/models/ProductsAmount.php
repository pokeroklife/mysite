<?php
declare(strict_types=1);

namespace app\modules\shop\models;

use yii\behaviors\TimestampBehavior;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "products_amount".
 *
 * @property int $id
 * @property int $product_id
 * @property int $amount
 * @property int $created_at
 * @property int $updated_at
 */
class ProductsAmount extends \yii\db\ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'products_amount';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['product_id', 'amount', 'price'], 'integer'],
            [['measure', 'currency'], 'string', 'max' => 100],
            [['amount', 'measure'], 'required'],
        ];
    }

    public function behaviors(): array
    {
        return [
            'class' => TimestampBehavior::class
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'amount' => 'Количество',
            'measure' => 'Единица измерения',
            'price' => 'Цена товара',
            'currency' => 'Валюта',
        ];
    }

    /**
     * @param int $id
     * @return ProductsAmount
     * @throws NotFoundHttpException
     */
    public static function findAmount(int $id): self
    {
        if (($model = self::findOne(['product_id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
