<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\components\ImageUploadComponent;
use app\modules\blog\controllers\ArticlesController;
use app\modules\blog\providers\ArticlesProvider;
use app\modules\blog\providers\CategoryProvider;
use yii\base\Action;
use yii\web\UploadedFile;

class UpdateAction extends Action
{
    private $articlesProvider;
    private $categoriesProvider;
    private $imageComponent;

    public function __construct(
        $id,
        ArticlesController $controller,
        ArticlesProvider $articlesProvider,
        CategoryProvider $categoriesProvider,
        ImageUploadComponent $imageComponent
    ) {
        parent::__construct($id, $controller);
        $this->articlesProvider = $articlesProvider;
        $this->categoriesProvider = $categoriesProvider;
        $this->imageComponent = $imageComponent;
    }


    public function run(int $id)
    {
        $model = $this->articlesProvider->getArticleCategoryTags($id);

        if ($model->load(\Yii::$app->request->post())) {
            $articles = \Yii::$app->request->post('Articles');
            try {
                if (($file = UploadedFile::getInstance($model, 'image')) !== null) {
                    $image = $this->imageComponent->saveImage($file);
                }
                if ($this->articlesProvider->updateArticle($articles)) {

                    \Yii::$app->session->setFlash('success', 'Статья изменена');
                    return $this->controller->redirect(['view', 'id' => $id]);
                }
            } catch (Exception $exception) {
                \Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }

        $categories = $this->categoriesProvider->getCategories();

        return $this->controller->render('create', [
            'model' => $model,
            'categories' => $categories,

        ]);
    }
}