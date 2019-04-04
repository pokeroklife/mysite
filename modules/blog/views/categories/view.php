<?php

use yii\helpers\Html;

?>
<h3>Все новости:</h3>
<?php foreach ($category as $model): ?>

    <div class="card">
        <h5><?= Html::encode($model->name) ?></h5>
        <?= Html::a(Html::img(('/img/small/' . $model->image),
            ['alt' => 'картинка', 'width' => '150px', 'height' => '150px']), ['news/view', 'id' => $model->id]); ?>
        <p><?= Html::encode($model->description) ?></p>
        <?= Html::a('Перейти на новость', ['news/view', 'id' => $model->id]); ?>
    </div>
<?php endforeach; ?>

