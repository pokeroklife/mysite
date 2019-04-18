<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\controllers\NewsController;
use app\modules\blog\models\TagsCreateForm;
use app\modules\blog\providers\NewsProvider;
use yii\base\Action;

class UpdateAction extends Action
{
    private $newsProvider;

    public function __construct($id, NewsController $controller, NewsProvider $newsProvider)
    {
        parent::__construct($id, $controller);
        $this->newsProvider = $newsProvider;
    }


    public function run(int $id)
    {
        $model = $this->newsProvider->getArticle($id);
        $model->load(\Yii::$app->request->post());
        $tagsForm = new TagsCreateForm();
        $tags = $this->newsProvider->getArticleTags($id);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->controller->redirect(['view', 'id' => $model->id]);
        }

        return $this->controller->render('update', [
            'model' => $model,
            'tagsForm' => $tagsForm,
            'tags' => $tags,
        ]);
    }
}