<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\controllers\ArticlesController;
use app\modules\blog\models\ArticleForm;
use app\modules\blog\providers\ArticlesProvider;
use app\modules\blog\providers\CategoryProvider;
use app\modules\blog\providers\TagsProvider;
use app\components\UploaderComponent;
use yii\base\Action;
use yii\db\Exception;

class CreateAction extends Action
{
    private $articlesProvider;
    private $categoriesProvider;
    private $tagsProvider;

    public function __construct(
        $id,
        ArticlesController $controller,
        ArticlesProvider $articlesProvider,
        CategoryProvider $categoriesProvider,
        TagsProvider $tagsProvider
    ) {
        parent::__construct($id, $controller);
        $this->articlesProvider = $articlesProvider;
        $this->categoriesProvider = $categoriesProvider;
        $this->tagsProvider = $tagsProvider;
    }

    public function run()
    {
        $model = new ArticleForm(['scenario' => ArticleForm::SCENARIO_CREATE_ARTICLE]);
        $categories = $this->categoriesProvider->getCategories();
        $tags = $this->tagsProvider->getTags();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            $model->authorId = \Yii::$app->user->id;

            try {
                $model->image = UploaderComponent::upload($model);
                if ($model->validate()
                    && ($this->articlesProvider->createArticle($model) !== null)
                ) {
                    \Yii::$app->session->setFlash('success', 'Статья сохранена');
                    return $this->controller->redirect('create');
                }
            } catch (Exception $exception) {
                \Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }
        return $this->controller->render('create',
            compact(
                'model',
                'categories',
                'tags'
            )
        );
    }
}