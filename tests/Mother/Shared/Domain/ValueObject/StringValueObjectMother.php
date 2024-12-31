<?php

namespace App\Tests\Mother\Shared\Domain\ValueObject;

use App\Shared\Domain\ValueObject\StringValueObject;
use Faker\Factory;

class StringValueObjectMother
{
    public static function create(string $value): StringValueObject
    {
        return StringValueObject::fromString($value);
    }

    public static function random(): StringValueObject
    {
        $faker = Factory::create();

        return self::create($faker->word());
    }
}