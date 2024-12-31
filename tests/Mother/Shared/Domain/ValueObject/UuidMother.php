<?php

namespace App\Tests\Mother\Shared\Domain\ValueObject;

use App\Shared\Domain\ValueObject\Uuid;
use Faker\Factory;

class UuidMother
{
    public static function create(string $uuid): Uuid
    {
        return Uuid::fromString($uuid);
    }

    public static function random(): Uuid
    {
        $faker = Factory::create();
        return self::create($faker->uuid());
    }
}