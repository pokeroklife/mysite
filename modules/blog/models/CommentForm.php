<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use yii\base\Model;

class CommentForm extends Model
{
    public $comment;

    public $newsId;

    public $username;

    public $parentId;

    public function rules(): array
    {
        return [
            [['comment', 'username', 'newsId'], 'required'],
            [['newsId', 'parentId'], 'integer'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'comment' => 'Коментарий'
        ];
    }
}