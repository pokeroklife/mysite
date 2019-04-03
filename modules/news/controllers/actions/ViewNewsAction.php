<?php
/**
 * Created by PhpStorm.
 * User: Романенко
 * Date: 27.03.2019
 * Time: 08:19
 */

namespace app\modules\news\controllers\actions;

use app\modules\news\controllers\NewsController;
use app\modules\news\providers\CategoryProvider;
use app\modules\news\providers\ViewNewsProvider;
use yii\base\Action;

class ViewNewsAction extends Action
{
    private $viewNewsProvider;
    private $categoryProvider;

    public function __construct(
        $id,
        NewsController $module,
        ViewNewsProvider $viewNewsProvider,
        CategoryProvider $categoryProvider
    ) {
        parent::__construct($id, $module);
        $this->viewNewsProvider = $viewNewsProvider;
        $this->categoryProvider = $categoryProvider;
    }

    public function run($id = null, $category = null)
    {
        if ($id === null and $category === null) {

            $news = $this->viewNewsProvider->getNews();
            $categories = $this->categoryProvider->getCategoryName();
            return $this->controller->render('allNews', compact('news', 'categories'));
        } else {
            if (isset($id)) {
                $news = $this->viewNewsProvider->getNews($id);
                return $this->controller->render('oneNews', compact('news'));
            } else {
                $categories = $this->categoryProvider->getCategoryName();
                $news = $this->categoryProvider->getCategoryNews($category);
                return $this->controller->render('allNews', compact('news', 'categories'));
            }
        }
    }
}