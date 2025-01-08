<?php

namespace App\Tests\Mother\Wine\Application\Command;

use App\Wine\Application\Command\CreateSensor;
use Faker\Factory;

class CreateSensorMother
{
    public static function create(string $name): CreateSensor
    {
        return new CreateSensor($name);
    }

    public static function random(): CreateSensor
    {
        $faker = Factory::create();
        return self::create(
            $faker->name()
        );
    }
}