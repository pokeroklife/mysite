<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

/* @var $content string */

use app\assets\NewsAppAssets;

NewsAppAssets::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="headersNews">
    <?php $this->beginBody() ?>
    <div>
        <ul class="menu_news">
            <li><?= Html::a('Home', ['../site']) ?></li>
            <li><?= Html::a('Все новости', ['./news/index']) ?></li>
            <li><?= Html::a('Новости по категориям', ['./categories/index']) ?></li>

            <?php if (Yii::$app->user->can('administration')): ?>
                <li><?= Html::a('Добавление категорий', ['./categories/create']) ?></li>
                <li><?= Html::a('Добавление новостей', ['./news/create']) ?></li>
            <?php endif; ?>

            <li>
                <?= Html::beginForm(['/site/logout'], 'post') ?>
                <?= Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                ) ?>
                <?= Html::endForm() ?>
            </li>
        </ul>
    </div>
    <?= $content ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>