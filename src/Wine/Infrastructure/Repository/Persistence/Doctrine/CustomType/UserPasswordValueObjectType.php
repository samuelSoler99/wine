<?php

namespace App\Wine\Infrastructure\Repository\Persistence\Doctrine\CustomType;

use App\Shared\Infrastructure\Repository\Persistence\Doctrine\CustomType\PasswordCustomValueObjectType;
use App\Wine\Domain\ValueObject\UserPasswordVO;

class UserPasswordValueObjectType extends PasswordCustomValueObjectType
{
    public function typeClassName(): string
    {
        return UserPasswordVO::class;
    }
}