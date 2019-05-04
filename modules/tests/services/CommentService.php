<?php

class CommentService
{
    private $provider;
    private $testFilter;

    public function __construct(CommentProvider $provider, TestFilterOneService $testFilter)
    {
        $this->provider = $provider;
    }

    public function getTests(): TestCollection
    {
        $test = $this->provider->findAll();
        return $this->filterByLevel($test);
    }

    public function filterByLevel(TestCollection $tests): TestCollection
    {
        $currentLevel = $this->getLevel();
        foreach ($tests as $test) {
            if($test->getLevel() !== $currentLevel) {
                $tests->remove($test->id);
            }
        }
        return $tests;
    }

    public function checkResult(Test $test): TestCollection
    {
        foreach ($test as $questions) {
            $result = $testFilter->filter($questions);
        }
        return $tests;
    }

    private function getLevel(): int
    {
        return 1;
    }
}