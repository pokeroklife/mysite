<?php

use \yii\helpers\Html;

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;

?>
<h1>Новости по категориям:</h1>
<ul>
    <?php foreach ($categories as $category): ?>
        <li><?= Html::a(Html::encode($category->name), ['news/view', 'category' => $category->id]) ?></li>


    <?php endforeach; ?>
</ul>
<h1>Все новости:</h1>
<?php foreach ($news as $model):?>

    <div class="card">
        <h5><?= Html::encode($model->name) ?></h5>
        <?= Html::a(Html::img(('/img/small/' . $model->upload_image),
            ['alt' => 'картинка', 'width' => '150px', 'height' => '150px']), ['news/view', 'id' => $model->id]); ?>
        <p><?= Html::encode($model->short_description) ?></p>
        <?= Html::a('Перейти на новость', ['news/view', 'id' => $model->id]); ?>
    </div>
<?php endforeach; ?>

