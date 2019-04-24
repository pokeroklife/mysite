<?php
declare(strict_types=1);

namespace app\modules\shop\controllers\actions\products;


use app\modules\shop\models\Products;
use yii\base\Action;
use yii\web\NotFoundHttpException;

/**
 * Class ViewAction
 * @package app\modules\shop\controllers\actions\products
 */
class ViewAction extends Action
{
    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function run(int $id): string
    {
        return $this->controller->render('view', [
            'model' => Products::findModel($id),
        ]);
    }
}