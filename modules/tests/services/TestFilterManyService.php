<?php

class TestFilterMany
{
    private $testFilter;

    public function __construct(CommentProvider $provider, TestFilterVideoService $testFilter)
    {
        $this->provider = $provider;
    }

    public function filter(question $question): TestCollection
    {
        if($question->type === 'many') {
        return $this->ckeck($questions);
    }
        return $this->provider->filter($question);
    }

    private function ckeck()
    {

    }
}