<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\WLang;



AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar',
            'id' => 'main-menu',
        ],
        'renderInnerContainer' => true,
        'innerContainerOptions' => [
            'class' => 'container'
        ],
        'brandLabel' => 'Site :)',
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => [
            'class' => 'navbar-brand'
        ],
    ]);

    $menuItems = [

    ];

    if (Yii::$app->user->can('administration')) {
        $menuItems[] = ['label' => \Yii::t('app', 'Home'), 'url' => ['/site/index']];
        $menuItems[] = ['label' => \Yii::t('app', 'Test'), 'url' => ['/test/index']];
        $menuItems[] = ['label' => \Yii::t('app', 'Gii'), 'url' => ['/gii']];
        $menuItems[] = ['label' => \Yii::t('app', 'SetRole'), 'url' => ['/admin/admin']];
        $menuItems[] = ['label' => \Yii::t('app', 'All news'), 'url' => ['/blog/articles']];
        $menuItems[] = ['label' => \Yii::t('app', 'News create'), 'url' => ['/blog/articles/create']];
        $menuItems[] = ['label' => \Yii::t('app', 'Shop'), 'url' => ['/shop/products']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    } else {
        if (Yii::$app->user->can('userRight')) {
            $menuItems[] = ['label' => 'Home', 'url' => ['/site/index']];
            $menuItems[] = ['label' => 'Все новости', 'url' => ['/blog/articles/']];
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        } else {
            $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        }
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,

    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? []
        ])
        ?>

        <?= WLang::widget();?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
