<?php
declare(strict_types=1);

namespace app\widgets;

use app\models\Lang;

/**
 * Class WLang
 * @package app\widgets
 */
class WLang extends \yii\bootstrap\Widget
{
    /**
     * @return string
     */
    public function run(): string
    {
        return $this->render('wlang/view', [
            'current' => Lang::getCurrent(),
            'langs' => Lang::find()->where('id != :current_id', [':current_id' => Lang::getCurrent()->id])->all(),
        ]);
    }
}