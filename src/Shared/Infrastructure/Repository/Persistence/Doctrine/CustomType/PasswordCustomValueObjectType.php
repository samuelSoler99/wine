<?php

namespace App\Shared\Infrastructure\Repository\Persistence\Doctrine\CustomType;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

abstract class PasswordCustomValueObjectType extends StringType
{
    public function getName(): string
    {
        return self::customTypeName();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return $this->typeClassName()::fromHash($value);
    }

    public static function customTypeName(): string
    {
        return (new \ReflectionClass(static::class))->getShortName();
    }

    abstract protected function typeClassName(): string;
}