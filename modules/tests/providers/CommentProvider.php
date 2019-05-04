<?php

class CommentProvider
{
    public function findAll(): TestCollection
    {
        $tests = Tests::findAll();
        $questions = questions::findAll();
        return new TestCollection($tests);
    }
}