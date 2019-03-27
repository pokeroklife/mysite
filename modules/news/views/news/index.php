<?php


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;


?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Начальная страница',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems = [

    ];

//    foreach ($categories as $category) {
//        $menuItems[] = ['label' => $category['name'], 'url' => ['/news/news/' . strtolower($category['name'])]];
//    }
    $menuItems[] = ['label' => 'News editor', 'url' => ['news/editor']];
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>
