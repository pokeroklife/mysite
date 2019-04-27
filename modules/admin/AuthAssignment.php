<?php
declare(strict_types=1);

namespace app\modules\admin;

use yii\db\ActiveQuery;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property string $item_name
 * @property string $user_id
 * @property int $created_at
 *
 * @property AuthItem $itemName
 * Class AuthAssignment
 * @package app\modules\admin
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'auth_assignment';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at'], 'integer'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
            [['item_name', 'user_id'], 'unique', 'targetAttribute' => ['item_name', 'user_id']],
            [
                ['item_name'],
                'exist',
                'skipOnError' => true,
                'targetClass' => AuthItem::class,
                'targetAttribute' => ['item_name' => 'name']
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'item_name' => 'Item Name',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getItemName(): ActiveQuery
    {
        return $this->hasOne(AuthItem::class, ['name' => 'item_name']);
    }


}
