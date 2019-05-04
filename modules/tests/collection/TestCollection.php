<?php
declare(strict_types=1);

class TestCollection implements \IteratorAggregate
{
    /**
     * @var Tests[]
     */
    private $item = [];

    public function __construct(iterable $data = [])
    {
        foreach ($data as $datum) {
            $this->set($datum);
        }
    }

    public function set(Tests $datum): void
    {
        $this->item[$datum->id] = $datum;
    }

    public function remove(int $id): void
    {
        unset($this->item[$id]);
    }

    /**
     * @return \Traversable|Tests[]
     */
    public function getIterator(): \Traversable
    {
        yield from $this->item;
    }
}