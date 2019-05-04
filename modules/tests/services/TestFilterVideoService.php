<?php

class TestFilterVideo
{
    private $testFilter;

    public function __construct(CommentProvider $provider, $testFilter)
    {
        $this->provider = $provider;
    }

    public function filter(question $question): TestCollection
    {
        if ($question->type === 'video') {
            return $this->ckeck($questions);
        }

    }

    private function ckeck()
    {

    }
}