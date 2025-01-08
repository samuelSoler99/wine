<?php

namespace App\Tests\Mother\Wine\Domain\Entity;

use App\Shared\Domain\ValueObject\StringValueObject;
use App\Shared\Domain\ValueObject\Uuid;
use App\Tests\Mother\Shared\Domain\ValueObject\StringValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Tests\Mother\Wine\Domain\ValueObject\UserPasswordMother;
use App\Wine\Domain\Entity\User;
use App\Wine\Domain\ValueObject\UserPasswordVO;

class UserMother
{
    private Uuid $uuid;
    private StringValueObject $name;
    private StringValueObject $lastName;
    private StringValueObject $email;
    private UserPasswordVO $password;

    public static function random(): User
    {
        return (new UserMother())->randomize()->instantiate();
    }

    public function randomize(): self
    {
        $this->uuid = UuidMother::random();
        $this->name = StringValueObjectMother::random();
        $this->lastName = StringValueObjectMother::random();
        $this->email = StringValueObjectMother::random();
        $this->password = UserPasswordMother::random();
        return $this;
    }

    public function withUuid(Uuid $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function withName(StringValueObject $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function withLastName(StringValueObject $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function withEmail(StringValueObject $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function withPassword(UserPasswordVO $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function instantiate(): User
    {
        return User::instantiate(
            $this->uuid,
            $this->name,
            $this->lastName,
            $this->email,
            $this->password
        );
    }
}