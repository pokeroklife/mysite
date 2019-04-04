<?php
declare(strict_types = 1);

namespace app\modules\blog\providers;

use app\modules\blog\models\News;
use app\modules\blog\models\NewsForm;

class NewsProvider
{
    /**
     * @return News[]
     */
    public function getNews(): array
    {
        return News::getNews();
    }

    public function getNew(int $id): News
    {
        return News::getNew($id);
    }

    public function deleteNew(int $id): bool
    {
        return News::deleteNew($id);
    }

    public function setNews()
    {

    }

    public function getModel()
    {
        $news = new NewsForm();

    }
}