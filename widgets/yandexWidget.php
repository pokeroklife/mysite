<?php
namespace app\widgets;
use yii\base\Widget;

class yandexWidget extends Widget
{
   public $width;
   public $height;

   public function init()
   {

   }

    public function run()
    {
        return '<iframe src="https://yandex.ua/map-widget/v1/-/CBFGiSBlTC" 
            width="' . $this->width . '" height="' . $this->height . '" frameborder="1" allowfullscreen="true"></iframe>';
    }
}
