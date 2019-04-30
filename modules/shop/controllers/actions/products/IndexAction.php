<?php
declare(strict_types=1);

namespace app\modules\shop\controllers\actions\products;

use app\modules\shop\models\ProductsSearch;
use yii\base\Action;

/**
 * Class IndexAction
 * @package app\modules\shop\controllers\actions\products
 */
class IndexAction extends Action
{
    /**
     * Lists all Products models.
     * @return mixed
     */
    public function run(): string
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $this->controller->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}