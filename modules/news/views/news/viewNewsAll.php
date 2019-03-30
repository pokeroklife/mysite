<?php
use \yii\helpers\Html;

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;

?>
<h1><?= Html::encode($this->title) ?></h1>
<?php foreach ($news as $model): ?>

    <div class="card" style="width: 18rem;">
        <img src=" /img/small/<?=$model->upload_image?>"  alt="картинка" width="150px" height="150px">

        <div class="card-body">
            <h5 class="card-title"><?= Html::encode($model->name) ?></h5>
            <p class="card-text"><?= Html::encode($model->short_description) ?></p>
            <a href="" class="btn btn-primary">Перейти на статью</a>
        </div>


    </div>
<?php endforeach; ?>

