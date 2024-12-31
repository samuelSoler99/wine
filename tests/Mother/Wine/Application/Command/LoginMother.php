<?php

namespace App\Tests\Mother\Wine\Application\Command;

use App\Wine\Application\Command\Login;
use Faker\Factory;

class LoginMother
{
    public static function create(string $email, string $password): Login
    {
        return new Login($email, $password);
    }

    public static function random(): Login
    {
        $faker = Factory::create();
        return self::create(
            $faker->email(),
            $faker->password(),
        );
    }
}