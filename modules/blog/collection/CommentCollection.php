<?php
declare(strict_types=1);

use app\modules\blog\models\Comment;

class CommentCollection implements \IteratorAggregate
{
/**
* @var Comment[]
*/
private $comments = [];

public function __construct(iterable $data = [])
{
foreach ($data as $datum) {
$this->add($datum);
}
}

public function add(Comment $datum): void
{
$this->comments[$datum->getId()] = $datum;
}

/**
* @return \Traversable|string[]
*/
public function getIterator(): \Traversable
{
yield from $this->comments;
}
}