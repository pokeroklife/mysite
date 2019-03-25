<?php


class ActionCreateNews extends \yii\base\Action
{
    public function run()
    {
//        $news = new NewsCreate();
        return $this->render('CategoryNewsCreate');
    }
}