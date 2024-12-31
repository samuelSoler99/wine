<?php

namespace App\Shared\Infrastructure\Repository\Persistence\Doctrine\CustomType;

use App\Shared\Domain\ValueObject\StringValueObject;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class StringValueObjectType extends StringType
{
    public function getName(): string
    {
        return self::customTypeName();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return $this->typeClassName()::fromString($value);
    }

    public static function customTypeName(): string
    {
        return (new \ReflectionClass(static::class))->getShortName();
    }

    protected function typeClassName(): string
    {
        return StringValueObject::class;
    }
}