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
use yii\web\UploadedFile;

/**
 * Class CreateAction
 * @package app\modules\shop\controllers\actions\products
 */
class CreateAction extends Action
{
    /**
     * @var ImageUploadComponent
     */
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
        $description = new ProductDetail(['scenario' => ProductDetail::SCENARIO_CREATE_PRODUCT]);
        $amount = new ProductsAmount();
        if (\Yii::$app->request->isPost
            && $model->load(\Yii::$app->request->post())
            && $description->load(\Yii::$app->request->post())
            && $amount->load(\Yii::$app->request->post())
            && ($file = UploadedFile::getInstance($description, 'image')) !== null
        ) {

            $description->image = $this->imageComponent->saveImage($file);

            if ($model->save()) {
                $description->product_id = $model->id;
                $amount->product_id = $model->id;


                if ($description->save() && $amount->save()) {
                    return $this->controller->redirect(['view', 'id' => $model->id]);
                }

            }
        }

        $categories = ProductsCategory::getCategories();
        return $this->controller->render('create', [
            'model' => $model,
            'categories' => $categories,
            'description' => $description,
            'amount' => $amount
        ]);
    }
}