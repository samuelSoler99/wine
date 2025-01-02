<?php

namespace App\Tests\Mother\Wine\Domain\ValueObject;

use App\Wine\Domain\ValueObject\UserPasswordVO;
use Faker\Factory;

class UserPasswordMother
{
    public static function create(string $password): UserPasswordVO
    {
        return UserPasswordVO::fromString($password);
    }

    public static function random(): UserPasswordVO
    {
        $faker = Factory::create();

        return self::create($faker->password(8,15));
    }
}