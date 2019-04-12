<?php

use \yii\helpers\Html;

$this->title = 'Новость';
$this->params['breadcrumbs'][] = array(
    'label' => 'Все новости',
    'url' => \yii\helpers\Url::toRoute('/blog/news/')
);
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<h3><?= Yii::$app->session->getFlash('success'); ?></h3>
<div class="new" style="width: 18rem;">
    <h5><?= Html::encode($model->name) ?></h5>
    <img src=" /img/<?= $model->image ?>" alt="картинка" width="500px" height="350px">
    <p> <?= Html::encode($model->text) ?></p>
    <?php if (Yii::$app->user->can('administration')): ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?php endif; ?>
</div>
<?= \app\components\Comments::widget(['commentForm' => $commentForm, 'label' => 'Отсавить комментарий', 'buttonName' => 'Оставить комментарий']) ?>
<?php foreach ($comments as $comment): ?>
    <ul>
        <li>
            <?= Html::tag('p', Html::encode($comment['username']), ['class' => 'comment_user_name']) ?>
            <?= Html::tag('p', Html::encode($comment['created_at']), ['class' => 'comment_date']) ?>
            <?= Html::tag('div', Html::tag('p', Html::encode($comment['comment'])), ['class' => 'comment']) ?>
        </li>
        <ul>
            <?php
            if (is_array($comment['childs'])): ?>
            <?php foreach ($comment['childs'] as $answer): ?>
                <li>
                    <?= Html::tag('p', Html::encode($answer['username']), ['class' => 'comment_user_name']) ?>
                    <?= Html::tag('p', Html::encode($answer['created_at']), ['class' => 'comment_date']) ?>
                    <?= Html::tag('div', Html::tag('p', Html::encode($answer['comment'])),
                        ['class' => 'comment']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <?= \app\components\Comments::widget(['commentForm' => $commentForm, 'commentId' => $comment['id'], 'buttonName' => 'Ответить на коментарий']) ?>

    </ul>
<?php endforeach; ?>








