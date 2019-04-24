<?php
declare(strict_types=1);

namespace app\modules\shop\controllers\actions\products;

use app\components\ImageUploadComponent;
use app\modules\shop\controllers\ProductsController;
use app\modules\shop\models\Products;
use yii\base\Action;
use yii\web\UploadedFile;

/**
 * Class CreateAction
 * @package app\modules\shop\controllers\actions\products
 */
class CreateAction extends Action
{
    private $imageComponent;

    /**
     * CreateAction constructor.
     * @param $id
     * @param ProductsController $controller
     * @param ImageUploadComponent $imageComponent
     */
    public function __construct(
        $id,
        ProductsController $controller,
        ImageUploadComponent $imageComponent

    ) {
        parent::__construct($id, $controller);
        $this->imageComponent = $imageComponent;

    }

    /**
     * @return string|\yii\web\Response
     */
    public function run()
    {
        $model = new Products(['scenario' => Products::SCENARIO_CREATE_PRODUCT]);

//        var_dump($model->validate());
        if (\Yii::$app->request->isPost
            && $model->load(\Yii::$app->request->post())
            && ($file = UploadedFile::getInstance($model, 'image')) !== null
            ) {

            $model->image = $this->imageComponent->saveImage($file);
            if ($model->save()) {
                return $this->controller->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->controller->render('create', [
            'model' => $model,
        ]);
    }
}