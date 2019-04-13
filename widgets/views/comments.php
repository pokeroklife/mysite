<?= \app\widgets\Comments::widget([
    'commentForm' => $commentForm,
    'label' => 'Оставить комментарий',
    'buttonName' => 'Оставить комментарий'
]) ?>


<?php
function commentRecurs($comments, $commentForm)
{
    $html = '';
    foreach ($comments as $comment) {
        $html .= '<li>' . $comment['username'] . $comment['created_at'];
        $html .= '<div class="commentText">' . $comment['comment'] . '</div>';
        $html .= \app\widgets\Comments::widget([
            'commentForm' => $commentForm,
            'commentId' => $comment['id'],
            'buttonName' => 'Ответить на комментарий'
        ]);
        if (isset($comment['childs']) && is_array($comment['childs'])) {
            $html .= '<ul>';
            $html .= commentRecurs($comment['childs'], $commentForm);
            $html .= '</ul>';
        }
        $html .= '</li>';
    }
    return $html;
}

?>
<br>
<?= commentRecurs($comments, $commentForm);
?>



