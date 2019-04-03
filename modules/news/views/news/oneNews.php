<?php

use \yii\helpers\Html;

$this->title = 'Новость';
$this->params['breadcrumbs'][] = $this->title;

?>
    <h1><?= Html::encode($this->title) ?></h1>

<?php foreach ($news as $item): ?>
    <div class="card_one" style="width: 18rem;">
        <h5><?= Html::encode($item->name) ?></h5>
        <img src=" /img/small/<?= $item->upload_image ?>" alt="картинка" width="200px" height="200px">
        <p> <?= Html::encode($item->short_description) ?></p>
        <p> <?= Html::encode($item->text) ?></p>
    </div>
<? endforeach; ?>