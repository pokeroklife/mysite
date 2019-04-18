<?= \app\widgets\Comments::widget([
    'commentForm' => $commentForm,
    'label' => 'Оставить комментарий',
    'buttonName' => 'Оставить комментарий'
]) ?>


<?php
function commentRecurs($comments, $commentForm, $newsId)
{
    $html = '';

    foreach ($comments as $comment) {
        if (Yii::$app->user->can('administration')) {
            $delete = \yii\helpers\Html::a('Delete', ['comment/delete', 'commentId' => $comment['id'], 'newsId' => $newsId], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        }
        $html .= '<li>' . $comment['username'] . $comment['created_at'] . $delete;
        $html .= '<div class="commentText">' . $comment['comment'] . '</div>';
        $html .= \app\widgets\Comments::widget([
            'commentForm' => $commentForm,
            'commentId' => $comment['id'],
            'buttonName' => 'Ответить на комментарий'
        ]);
        if (isset($comment['childs']) && is_array($comment['childs'])) {
            $html .= '<ul>';
            $html .= commentRecurs($comment['childs'], $commentForm, $newsId);
            $html .= '</ul>';
        }
        $html .= '</li>';
    }
    return $html;
}

?>
<br>
<?= commentRecurs($comments, $commentForm, $newsId)
?>



