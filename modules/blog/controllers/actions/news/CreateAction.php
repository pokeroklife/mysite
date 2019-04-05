<?php
declare(strict_types=1);

namespace app\modules\blog\controllers\actions\news;

use app\modules\blog\controllers\NewsController;
use app\modules\blog\models\NewsCreateForm;
use app\modules\blog\providers\ImageProvider;
use app\modules\blog\providers\NewsProvider;
use yii\base\Action;
use yii\web\UploadedFile;

class CreateAction extends Action
{
    private $newsProvider;
    private $imageProvider;

    public function __construct(
        $id,
        NewsController $controller,
        NewsProvider $newsProvider,
        ImageProvider $imageProvider
    ) {
        parent::__construct($id, $controller);
        $this->newsProvider = $newsProvider;
        $this->imageProvider = $imageProvider;
    }

    public function run()
    {
        $model = new NewsCreateForm();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            $model->authorId = \Yii::$app->user->id;
            $model->image = $this->imageProvider->upload($model);


            if ($model->validate() && ($news = $this->newsProvider->setNews($model)) !== null) {
                \Yii::$app->session->setFlash('success', 'Статья сохранена');
                return $this->controller->render('view', compact('model'));;
            } else {
                \Yii::$app->session->setFlash('success', 'Статья не сохранена');
            }
        }

        return $this->controller->render('create', compact('model'));
    }
}