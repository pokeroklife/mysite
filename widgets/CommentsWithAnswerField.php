<?php
declare(strict_types=1);

namespace app\widgets;

use yii\base\Widget;

class CommentsWithAnswerField extends Widget
{
    public $commentForm = [];

    public $comments = [];
    public $newsId;

    public function run(): string
    {
        return $this->render('comments', [
            'commentForm' => $this->commentForm,
            'comments' => $this->comments,
            'newsId' => $this->newsId,

        ]);
    }

}


