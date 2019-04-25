<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\components\ImageUploadComponent;
use app\modules\blog\controllers\ArticlesController;
use app\modules\blog\models\ArticleForm;
use app\modules\blog\providers\ArticlesProvider;
use app\modules\blog\providers\CategoryProvider;
use app\modules\blog\providers\TagsProvider;
use yii\base\Action;
use yii\db\Exception;
use yii\web\UploadedFile;

/**
 * Class CreateAction
 * @package app\modules\blog\controllers\actions\news
 *
 */
class CreateAction extends Action
{
    private $articlesProvider;
    private $categoriesProvider;
    private $tagsProvider;
    private $imageComponent;

    public function __construct(
        $id,
        ArticlesController $controller,
        ArticlesProvider $articlesProvider,
        CategoryProvider $categoriesProvider,
        TagsProvider $tagsProvider,
        ImageUploadComponent $imageComponent

    ) {
        parent::__construct($id, $controller);
        $this->articlesProvider = $articlesProvider;
        $this->categoriesProvider = $categoriesProvider;
        $this->tagsProvider = $tagsProvider;
        $this->imageComponent = $imageComponent;
    }

//    public function run()
//    {
//        $article = new Articles();
//
//        if (\Yii::$app->request->isPost) {
//            $article->load(\Yii::$app->request->post());
//            $article->tags = \Yii::$app->request->post('tags');
//            $article->authorId = \Yii::$app->user->id;
//
//            try {
////                $article->image = UploaderComponent::upload($model);
//                if ($article->validate() && ($this->articlesProvider->createArticle($model) !== null)) {
//                    \Yii::$app->session->setFlash('success', 'Статья сохранена');
//                    return $this->controller->redirect('create');
//                }
//            } catch (Exception $exception) {
//                \Yii::$app->session->setFlash('error', $exception->getMessage());
//            }
//        }
//
//        $categories = $this->categoriesProvider->getCategories();
//        $tags = $this->tagsProvider->getTags();
//
//        return $this->controller->render('create',
//            compact(
//                'article',
//                'categories',
//                'tags'
//            )
//        );
//    }
    /**
     * @return string|\yii\web\Response
     */
    public function run()
    {
        $model = new ArticleForm(['scenario' => ArticleForm::SCENARIO_CREATE_ARTICLE]);

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            $model->authorId = \Yii::$app->user->id;
            $file = UploadedFile::getInstance($model, 'image');
            try {
                $model->image = $this->imageComponent->saveImage($file);
                if ($model->validate() && ($this->articlesProvider->createArticle($model) !== null)) {
                    \Yii::$app->session->setFlash('success', 'Статья сохранена');
                    return $this->controller->redirect('create');
                }
            } catch (Exception $exception) {
                \Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }

        $categories = $this->categoriesProvider->getCategories();
       $model->tags = $this->tagsProvider->getTags();

        return $this->controller->render('create',
            compact(
                'model',
                'categories'
            )
        );
    }
}