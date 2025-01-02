<?php

namespace App\Wine\Domain\Entity;

use App\Shared\Domain\ValueObject\StringValueObject;
use App\Shared\Domain\ValueObject\Uuid;
use App\Wine\Domain\ValueObject\UserPasswordVO;

class User
{
    private function __construct(
        private Uuid $id,
        private StringValueObject $name,
        private StringValueObject $lastName,
        private StringValueObject $email,
        private UserPasswordVO $password,
    ) {
    }

    public static function instantiate(
        Uuid $id,
        StringValueObject $name,
        StringValueObject $lastName,
        StringValueObject $email,
        UserPasswordVO $password
    ): self {
        return new self(
            $id,
            $name,
            $lastName,
            $email,
            $password
        );
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function name(): StringValueObject
    {
        return $this->name;
    }

    public function lastName(): StringValueObject
    {
        return $this->lastName;
    }

    public function email(): StringValueObject
    {
        return $this->email;
    }

    public function password(): UserPasswordVO
    {
        return $this->password;
    }
}