<?php
declare(strict_types=1);

namespace app\modules\shop\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "product_detail".
 *
 * @property int $id
 * @property int $product_id
 * @property string $description
 * @property string $detail
 * @property string $image
 * @property int $created_at
 * @property int $updated_at
 */
class ProductDetail extends \yii\db\ActiveRecord
{
    public const SCENARIO_CREATE_PRODUCT = 'create';

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
            [['image'], 'required', 'on' => self::SCENARIO_CREATE_PRODUCT],
            [['image'], 'file', 'extensions' => 'jpg, png'],
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
            'image' => 'Изображение товара',

        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(Products::class, ['id' => 'product_id']);
    }

    /**
     * @param int $id
     * @return self
     * @throws NotFoundHttpException
     */
    public static function findDescription(int $id): self
    {
        if (($model = self::findOne(['product_id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
