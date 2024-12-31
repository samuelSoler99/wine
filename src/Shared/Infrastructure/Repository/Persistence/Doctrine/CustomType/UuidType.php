<?php

namespace App\Shared\Infrastructure\Repository\Persistence\Doctrine\CustomType;

use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class UuidType extends StringType
{
    public function getName(): string
    {
        return static::customTypeName();
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
        return Uuid::class;
    }
}
