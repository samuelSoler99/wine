<?php

namespace App\Tests\Mother\Wine\Application\Command;

use App\Wine\Application\Command\ListWines;

class ListWinesMother
{
    public static function create(): ListWines
    {
        return new ListWines();
    }

    public static function random(): ListWines
    {
        return self::create();
    }
}