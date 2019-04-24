<?php
declare(strict_types=1);

namespace app\modules\shop\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product_detail".
 *
 * @property int $id
 * @property int $product_id
 * @property string $description
 * @property string $detail
 * @property int $created_at
 * @property int $updated_at
 */
class ProductDetail extends \yii\db\ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'product_detail';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['product_id', 'description', 'detail'], 'required'],
            [['product_id'], 'integer'],
            [['detail'], 'string'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
     */
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
            'description' => 'Описание товара',
            'detail' => 'Характеристики товара',

        ];
    }
}
