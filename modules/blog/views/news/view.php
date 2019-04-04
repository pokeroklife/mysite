<?php

use \yii\helpers\Html;

$this->title = 'Новость';
$this->params['breadcrumbs'][] = $this->title;

?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="new" style="width: 18rem;">
    <h5><?= Html::encode($new->name) ?></h5>
    <img src=" /img/<?= $new->image ?>" alt="картинка" width="500px" height="350px">
    <p> <?= Html::encode($new->description) ?></p>
    <p> <?= Html::encode($new->text) ?></p>
</div>
