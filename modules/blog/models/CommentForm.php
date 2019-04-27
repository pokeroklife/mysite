<?php
declare(strict_types=1);

namespace app\modules\blog\models;

use yii\base\Model;

/**
 * Class CommentForm
 * @package app\modules\blog\models
 */
class CommentForm extends Model
{
    /**
     * @var
     */
    public $comment;
    /**
     * @var
     */
    public $newsId;
    /**
     * @var
     */
    public $username;
    /**
     * @var
     */
    public $parentId;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['comment', 'username', 'newsId'], 'required'],
            [['newsId', 'parentId'], 'integer'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'comment' => 'Коментарий'
        ];
    }
}