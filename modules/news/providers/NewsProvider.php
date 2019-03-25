<?php
/**
 * Created by PhpStorm.
 * User: Романенко
 * Date: 24.03.2019
 * Time: 11:33
 */

namespace app\modules\news\providers;

use app\modules\news\Categories;

class NewsProvider
{
    public function getCategoryName(): array
    {
        return Categories::getCategoryName();
    }


}