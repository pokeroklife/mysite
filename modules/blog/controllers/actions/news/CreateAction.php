<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\controllers\NewsController;
use app\modules\blog\models\NewsCreateForm;
use app\modules\blog\providers\CategoryProvider;
use app\modules\blog\providers\ImageProvider;
use app\modules\blog\providers\NewsProvider;
use app\modules\blog\providers\TagsProvider;
use yii\base\Action;

class CreateAction extends Action
{
    private $newsProvider;
    private $categoriesProvider;
    private $tagsProvider;
    private $imageProvider;

    public function __construct(
        $id,
        NewsController $controller,
        NewsProvider $newsProvider,
        CategoryProvider $categoriesProvider,
        TagsProvider $tagsProvider,
        ImageProvider $imageProvider
    ) {
        parent::__construct($id, $controller);
        $this->newsProvider = $newsProvider;
        $this->categoriesProvider = $categoriesProvider;
        $this->tagsProvider = $tagsProvider;
        $this->imageProvider = $imageProvider;
    }

    public function run()
    {
        $model = new NewsCreateForm();
        $categories = $this->categoriesProvider->getCategories();
        $tags = $this->tagsProvider->getTags();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            $model->authorId = \Yii::$app->user->id;
            $model->image = $this->imageProvider->upload($model);

            if ($model->validate()
                && ($news = $this->newsProvider->createArticle($model)) !== null
                && $this->tagsProvider->createRelationArticleTags($model, $news)) {

                \Yii::$app->session->setFlash('success', 'Статья сохранена');
            } else {
                \Yii::$app->session->setFlash('success', 'Статья не сохранена');
            }
        }

        return $this->controller->render('create',
            compact(
                'model',
                'categories',
                'tags'));
    }
}