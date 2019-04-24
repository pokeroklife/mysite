<?php
declare(strict_types=1);

namespace app\modules\shop\controllers\actions\products;

use app\components\ImageUploadComponent;
use app\modules\shop\controllers\ProductsController;
use app\modules\shop\models\Products;
use yii\base\Action;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * Class UpdateAction
 * @package app\modules\shop\controllers\actions\products
 */
class UpdateAction extends Action
{
    /**
     * @var ImageUploadComponent
     */
    private $imageComponent;
    public function __construct(
        $id,
        ProductsController $controller,
        ImageUploadComponent $imageComponent

    ) {
        parent::__construct($id, $controller);
        $this->imageComponent = $imageComponent;

    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function run(int $id)
    {
        $model = Products::findModel($id);
        $currentImage = $model->image;
        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if (($file = UploadedFile::getInstance($model, 'image')) !== null) {
                $model->image = $this->imageComponent->saveImage($file);
                $this->imageComponent->deleteCurrentImage($currentImage);

            } else {
                $model->image = $currentImage;
            }
            if ($model->save()) {
                return $this->controller
                    ->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->controller->render('update', [
            'model' => $model,
        ]);
    }


}