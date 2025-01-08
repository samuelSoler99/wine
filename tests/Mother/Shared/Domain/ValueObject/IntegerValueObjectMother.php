<?php

namespace App\Tests\Mother\Shared\Domain\ValueObject;

use App\Shared\Domain\ValueObject\IntegerValueObject;
use Faker\Factory;

class IntegerValueObjectMother
{
    public static function create(int $value): IntegerValueObject
    {
        return IntegerValueObject::fromInt($value);
    }

    public static function random($numberDigits = 0): IntegerValueObject
    {
        $faker = Factory::create();

        return self::create($faker->randomNumber($numberDigits));
    }
}