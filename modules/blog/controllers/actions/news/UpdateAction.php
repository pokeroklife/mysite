<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\components\UploaderComponent;
use app\modules\blog\controllers\ArticlesController;
use app\modules\blog\models\ArticleForm;
use app\modules\blog\providers\ArticlesProvider;
use app\modules\blog\providers\CategoryProvider;
use yii\base\Action;

class UpdateAction extends Action
{
    private $articlesProvider;
    private $categoriesProvider;

    public function __construct(
        $id,
        ArticlesController $controller,
        ArticlesProvider $articlesProvider,
        CategoryProvider $categoriesProvider
    ) {
        parent::__construct($id, $controller);
        $this->articlesProvider = $articlesProvider;
        $this->categoriesProvider = $categoriesProvider;
    }


    public function run(int $id)
    {
        $model = new ArticleForm();
        if ($model->load(\Yii::$app->request->post())) {
            $model->authorId = \Yii::$app->user->id;
            try {
                if (isset($model->image)) {
                    $model->image = UploaderComponent::upload($model);
                }

                if ($model->validate()
                    && ($this->articlesProvider->updateArticle($model, $id) !== null)
                ) {

                    \Yii::$app->session->setFlash('success', 'Статья изменена');
                    return $this->controller->redirect(['view', 'id' => $id]);
                }
            } catch (Exception $exception) {
                \Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        } else {
            $model = $this->articlesProvider->getOldModel($model, $id);
        }
        $categories = $this->categoriesProvider->getCategories();
        $tags = $this->articlesProvider->getArticleTags($id);

        return $this->controller->render('create', [
            'model' => $model,
            'categories' => $categories,
            'tags' => $tags,

        ]);
    }
}