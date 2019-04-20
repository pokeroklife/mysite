<?php
declare(strict_types=1);

use \yii\helpers\Html;

$this->title = 'Новость';
$this->params['breadcrumbs'][] = array(
    'label' => 'Все новости',
    'url' => \yii\helpers\Url::toRoute('/blog/articles/')
);
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (isset($tags)): ?>
    <?php foreach ($tags as $tag): ?>
        <?= Html::a($tag->name, ['/blog/articles/', 'tagId' => $tag->id]) ?>
    <?php endforeach; ?>
<?php endif; ?>

<h1><?= Html::encode($this->title) ?></h1>
<h3><?= Yii::$app->session->getFlash('success') ?></h3>
<div class="new" style="width: 18rem;">
    <h5><?= Html::encode($model->name) ?></h5>
    <img src=" /img/<?= $model->image ?>" alt="картинка" width="500px" height="350px">
    <p> <?= Html::encode($model->text) ?></p>
    <?php if (Yii::$app->user->can('administration')): ?>
        <?= Html::a('Update', [
            'update',
            'id' => $model->id,
        ],
            ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?php endif ?>
</div>
<?= \app\widgets\CommentsWithAnswerField::widget([
    'commentForm' => $commentForm,
    'comments' => $comments,
    'newsId' => $model->id,
]) ?>






