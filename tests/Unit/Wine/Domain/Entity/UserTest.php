<?php

namespace App\Tests\Unit\Wine\Domain\Entity;

use App\Tests\Mother\Shared\Domain\ValueObject\StringValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Wine\Domain\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testInstantiate(): void
    {
            $uuid = UuidMother::random();
            $name = StringValueObjectMother::random();
            $lastName = StringValueObjectMother::random();
            $email = StringValueObjectMother::random();
            $password = StringValueObjectMother::random();

            $user = User::instantiate(
                $uuid,
                $name,
                $lastName,
                $email,
                $password
            );

            $this->assertInstanceOf(User::class, $user);
            $this->assertEquals($uuid,$user->id());
            $this->assertEquals($name,$user->name());
            $this->assertEquals($lastName,$user->lastName());
            $this->assertEquals($email,$user->email());
            $this->assertEquals($password,$user->password());
    }
}