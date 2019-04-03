<?php
/* @var $this yii\web\View */

/* @var $form yii\bootstrap\ActiveForm */

use app\assets\MyAppAsset;

MyAppAsset::register($this);

$this->beginPage();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Магазин электроники</title>
    <? $this->head(); ?>
</head>

<body>
<?php $this->beginBody(); ?>
    <div class="header">
        <div class="menu">
            <ul class="menu_shop">
                <li><a href="/site/index">Home</a></li>
                <li><a href="index">Главная</a></li>
                <li><a class="selected" href="catalog">Каталог</a></li>
                <li><a href="contact">Контакты</a></li>
            </ul>
        </div>
    </div>
<?= $content ?>
<div>
<footer class="footer">
    <sup>&copy; Все права защищены</sup>
</footer>
</div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage() ?>
