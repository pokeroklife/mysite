<?php

class TestFilterOne
{
    private $testFilter;

    public function __construct(CommentProvider $provider, TestFilterManyService $testFilter)
    {
        $this->provider = $provider;
    }

    public function filter(question $question): TestCollection
    {
        if ($question->type === 'one') {
            return $this->ckeck($questions);
        }
        return $this->provider->filter($question);
    }

    private function ckeck()
    {

    }

}