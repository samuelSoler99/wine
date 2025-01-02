<?php

namespace App\Wine\Domain\ValueObject;

use App\Shared\Domain\ValueObject\PasswordValueObject;
use App\Wine\Domain\Exception\InvalidPassword;

final readonly class UserPasswordVO extends PasswordValueObject
{
    private const MINIMUM_PASSWORD_LENGTH = 8;

    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    public static function fromString(?string $string): ?self
    {
        self::checkPassword($string);
        return parent::fromString($string);
    }

    /**
     * @throws InvalidPassword
     */
    private static function checkPassword(string $password): void
    {
        if (
            strlen($password) < self::MINIMUM_PASSWORD_LENGTH
        ) {
            throw new InvalidPassword('Invalid password, the password does not satisfy the necessary requirements', 400);
        }
    }
}