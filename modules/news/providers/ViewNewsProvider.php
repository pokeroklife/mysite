<?php

namespace app\modules\news\providers;

use app\modules\news\models\NewsCreate;

class ViewNewsProvider
{
    public function GetNews()
    {
       return NewsCreate::getNews();
    }
}