<?php
declare(strict_types=1);

namespace app\modules\shop\controllers\actions\products;

use yii\web\NotFoundHttpException;

use app\modules\shop\models\Products;
use yii\base\Action;
use yii\web\Response;

/**
 * Class DeleteAction
 * @package app\modules\shop\controllers\actions\products
 */
class DeleteAction extends Action
{
    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Exception|\Throwable in case delete failed.
     */
    public function run(int $id): Response
    {
        $model = Products::findModel($id);
        $model->delete();
        return $this->controller->redirect(['index']);
    }
}