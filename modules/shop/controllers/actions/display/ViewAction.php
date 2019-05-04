<?php
declare(strict_types=1);

namespace app\modules\shop\controllers\actions\display;

use app\modules\shop\models\Products;

class ViewAction extends \yii\base\Action
{
    public function run(int $id)
    {
        $model = Products::getInfo($id);

        return $this->controller->render('view', ['model' => $model]);
    }
}