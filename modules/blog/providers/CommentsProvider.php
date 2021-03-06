<?php
declare(strict_types=1);

namespace app\modules\blog\providers;

use \app\modules\blog\models\Comment;
use app\modules\blog\models\CommentForm;

class CommentsProvider
{
    public function getComment(int $id): array
    {
        $comments = Comment::getComment($id);
        $transformComments = $this->transformComments($comments);
        return $this->buildCommentTree($transformComments);
    }

    public function createComment(CommentForm $model): bool
    {
        $comment = new Comment();
        $comment->comment = $model->comment;
        $comment->article_id = $model->newsId;
        $comment->username = $model->username;
        $comment->parent_id = $model->parentId;

        return $comment->save();
    }


    public function buildCommentTree($data): array
    {
        $tree = [];
        foreach ($data as $id => &$row) {
            if (empty($row['parent_id'])) {
                $tree[$id] = &$row;
            } else {
                $data[$row['parent_id']]['childs'][$id] = &$row;
            }
        }
        return $tree;
    }

    public function transformComments(array $comments): array
    {
        $transformComments = [];
        foreach ($comments as $comment) {
            $transformComments[$comment['id']] = $comment;
        }

        return $transformComments;
    }

    public function deleteComment(int $commentId): bool
    {
        return Comment::deleteComment($commentId);
    }
}
