<?php
declare(strict_types=1);

namespace app\widgets;

use yii\base\Widget;

class Comments extends Widget
{
    public $commentForm = [];

    public $commentId;

    public $label = false;

    public $buttonName = '';

    public function run(): string
    {

        return $this->render('index', [
            'commentForm' => $this->commentForm,
            'commentId' => $this->commentId,
            'label' => $this->label,
            'buttonName' => $this->buttonName,
        ]);
    }
}