<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\tags;

use app\modules\blog\controllers\TagsController;
use app\modules\blog\models\TagsCreateForm;
use app\modules\blog\providers\TagsProvider;
use yii\base\Action;

class CreateAction extends Action
{
    private $tagsProvider;

    public function __construct($id, TagsController $controller, TagsProvider $tagsProvider)
    {
        parent::__construct($id, $controller);
        $this->tagsProvider = $tagsProvider;
    }

    public function run(): string
    {
        $model = new TagsCreateForm();
        if ($model->load(\Yii::$app->request->post())
            && $model->validate()
            && $this->tagsProvider->createTag($model)) {
            \Yii::$app->session->setFlash('success', 'Тэг сохранен');
        }
        return $this->controller->render('create', compact('model'));
    }
}