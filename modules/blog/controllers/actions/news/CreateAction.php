<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\components\ImageUploadComponent;
use app\modules\blog\controllers\ArticlesController;
use app\modules\blog\models\Articles;
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
    /**
     * @var CategoryProvider
     */
    private $categoriesProvider;
    /**
     * @var TagsProvider
     */
    private $tagsProvider;
    /**
     * @var ImageUploadComponent
     */
    private $imageComponent;

    /**
     * CreateAction constructor.
     * @param $id
     * @param ArticlesController $controller
     * @param CategoryProvider $categoriesProvider
     * @param TagsProvider $tagsProvider
     * @param ImageUploadComponent $imageComponent
     */
    public function __construct(
        $id,
        ArticlesController $controller,
        CategoryProvider $categoriesProvider,
        TagsProvider $tagsProvider,
        ImageUploadComponent $imageComponent

    ) {
        parent::__construct($id, $controller);
        $this->categoriesProvider = $categoriesProvider;
        $this->tagsProvider = $tagsProvider;
        $this->imageComponent = $imageComponent;
    }

    /**
     * @return string|\yii\web\Response
     */
    public function run()
    {
        $model = new Articles(['scenario' => Articles::SCENARIO_CREATE_ARTICLE]);

        if (\Yii::$app->request->isPost
            && $model->load(\Yii::$app->request->post())
            && ($file = UploadedFile::getInstance($model, 'image')) !== null) {
            try {
                $model->author_id = \Yii::$app->user->id;
                $model->image = $this->imageComponent->saveImage($file);

                if ($model->save()) {
                    \Yii::$app->session->setFlash('success', 'Статья сохранена');
                    return $this->controller->redirect('create');
                }
            } catch (Exception $exception) {
                \Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }

        $categories = $this->categoriesProvider->getCategories();
        $model->tag = $this->tagsProvider->getTags();

        return $this->controller->render('create',
            compact(
                'model',
                'categories'
            )
        );
    }
}