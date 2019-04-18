<?php

use \yii\helpers\Html;

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php if(isset($tags)): ?>
<?php foreach ($tags as $tag): ?>

    <?= Html::a($tag->name, ['/blog/news/', 'tagId' => $tag->id]) ?>

<?php endforeach ?>
<?php endif ?>
<h2>Новости по категориям:</h2>
<?= Html::a('Категории Новостей', ['/blog/categories/']) ?>
<h3><?= Yii::$app->session->getFlash('success') ?></h3>
<h3>Все новости:</h3>
<?php foreach ($models as $model): ?>

    <div class="card">
        <h5><?= Html::encode($model->name) ?></h5>
        <?= Html::a(Html::img(('/img/small/' . $model->image),
            ['alt' => 'картинка', 'width' => '150px', 'height' => '150px']), ['news/view', 'id' => $model->id]) ?>
        <p><?= Html::encode($model->description) ?></p>
        <?= Html::a('Перейти на новость', ['news/view', 'id' => $model->id]) ?>
    </div>
<?php endforeach; ?>


