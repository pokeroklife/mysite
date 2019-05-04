<?php
declare(strict_types=1);

namespace app\modules\blog\models;


class Tests extends ActiveRecord
{
    public static function findAll(): array
    {
        return [];
    }

    public function getLevel(): int
    {
        return random_int(1,3);
    }
}