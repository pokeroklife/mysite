<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\components\ImageUploadComponent;
use app\modules\blog\controllers\ArticlesController;
use app\modules\blog\models\Articles;
use app\modules\blog\providers\CategoryProvider;
use yii\base\Action;
use yii\db\Exception;
use yii\web\UploadedFile;

/**
 * Class UpdateAction
 * @package app\modules\blog\controllers\actions\news
 */
class UpdateAction extends Action
{
    /**
     * @var CategoryProvider
     */
    private $categoriesProvider;
    /**
     * @var ImageUploadComponent
     */
    private $imageComponent;

    /**
     * UpdateAction constructor.
     * @param $id
     * @param ArticlesController $controller
     * @param CategoryProvider $categoriesProvider
     * @param ImageUploadComponent $imageComponent
     */
    public function __construct(
        $id,
        ArticlesController $controller,
        CategoryProvider $categoriesProvider,
        ImageUploadComponent $imageComponent
    ) {
        parent::__construct($id, $controller);
        $this->categoriesProvider = $categoriesProvider;
        $this->imageComponent = $imageComponent;
    }

    /**
     * @param int $id
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */

    public function run(int $id)
    {
        $model = Articles::findModel($id);
        $currentImage = $model->image;

        if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())) {
            $articles = \Yii::$app->request->post('Articles');
            $model->tag = $articles['tag'];

            try {
                if (($file = UploadedFile::getInstance($model, 'image')) !== null) {
                    $model->image = $this->imageComponent->saveImage($file);
                    $this->imageComponent->deleteCurrentImage($currentImage);
                } else {
                    $model->image = $currentImage;
                }

                if ($model->save()) {
                    \Yii::$app->session->setFlash('success', 'Статья изменена');
                    return $this->controller->redirect(['view', 'id' => $id]);
                }
            } catch (Exception $exception) {
                \Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }

        $categories = $this->categoriesProvider->getCategories();
        $model->tag = Articles::findOne($id)->tags;
        return $this->controller->render('create', [
            'model' => $model,
            'categories' => $categories,

        ]);
    }
}