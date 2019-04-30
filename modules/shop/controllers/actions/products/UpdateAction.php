<?php
declare(strict_types=1);

namespace app\modules\shop\controllers\actions\products;

use app\components\ImageUploadComponent;
use app\modules\shop\controllers\ProductsController;
use app\modules\shop\models\ProductDetail;
use app\modules\shop\models\Products;
use app\modules\shop\models\ProductsAmount;
use app\modules\shop\models\ProductsCategory;
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
        $description = ProductDetail::findDescription($id);
        $amount = ProductsAmount::findAmount($id);

        $currentImage = $description->image;
        if (\Yii::$app->request->isPost
            && $model->load(\Yii::$app->request->post())
            && $description->load(\Yii::$app->request->post())
            && $amount->load(\Yii::$app->request->post())) {

            if (($file = UploadedFile::getInstance($description, 'image')) !== null) {
                $description->image = $this->imageComponent->saveImage($file);
                $this->imageComponent->deleteCurrentImage($currentImage);

            } else {
                $description->image = $currentImage;
            }

            if ($model->save() && $description->save() && $amount->save()) {
                return $this->controller
                    ->redirect(['view', 'id' => $model->id]);
            }
        }
        $categories = ProductsCategory::getCategories();
        return $this->controller->render('update', [
            'model' => $model,
            'categories' => $categories,
            'description' => $description,
            'amount' => $amount
        ]);
    }


}