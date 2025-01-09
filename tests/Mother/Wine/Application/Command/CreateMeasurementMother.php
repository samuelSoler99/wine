<?php

namespace App\Tests\Mother\Wine\Application\Command;

use App\Wine\Application\Command\CreateMeasurement;
use Faker\Factory;

class CreateMeasurementMother
{
    public static function create(
        string $idSensor,
        string $idWine,
        string $color,
        int $year,
        int $temperature,
        int $graduation,
        int $pH
    ): CreateMeasurement {
        return new CreateMeasurement(
            $idSensor,
            $idWine,
            $color,
            $year,
            $temperature,
            $graduation,
            $pH
        );
    }

    public static function random(): CreateMeasurement
    {
        $faker = Factory::create();
        return self::create(
            $faker->uuid(),
            $faker->uuid(),
            $faker->uuid(),
            $faker->randomNumber(2),
            $faker->randomNumber(2),
            $faker->randomNumber(2),
            $faker->randomNumber(2),
        );
    }
}