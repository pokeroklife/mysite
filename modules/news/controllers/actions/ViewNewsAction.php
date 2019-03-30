<?php
/**
 * Created by PhpStorm.
 * User: Романенко
 * Date: 27.03.2019
 * Time: 08:19
 */

namespace app\modules\news\controllers\actions;

use app\modules\news\controllers\NewsController;
use app\modules\news\providers\ViewNewsProvider;
use yii\base\Action;

class ViewNewsAction extends Action
{
    private $viewNewsProvider;

    public function __construct($id, NewsController $module, ViewNewsProvider $viewNewsProvider)
    {
        parent::__construct($id, $module);
        $this->viewNewsProvider = $viewNewsProvider;
    }
    public function run()
    {
        $news = $this->viewNewsProvider->GetNews();
        return $this->controller->render('viewNewsAll', compact('news'));
    }
}