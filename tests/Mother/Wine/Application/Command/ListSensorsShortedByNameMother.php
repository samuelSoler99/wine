<?php

namespace App\Tests\Mother\Wine\Application\Command;

use App\Wine\Application\Command\ListSensorsShortedByName;

class ListSensorsShortedByNameMother
{
    public static function create(): ListSensorsShortedByName
    {
        return new ListSensorsShortedByName();
    }

    public static function random(): ListSensorsShortedByName
    {
        return self::create();
    }
}