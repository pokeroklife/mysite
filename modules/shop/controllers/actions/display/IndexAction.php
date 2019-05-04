<?php
declare(strict_types=1);

namespace app\modules\shop\controllers\actions\display;

use app\modules\shop\models\Products;

class IndexAction extends \yii\base\Action
{
    public function run()
    {
        $model = Products::getInfo();

        return $this->controller->render('index', ['model' => $model]);
    }
}