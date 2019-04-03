<?php

namespace app\modules\news\providers;

use app\modules\news\models\News;

class ViewNewsProvider
{
    public function getNews($id = null)
    {
        return News::selectNews($id);
    }
}