<?php

namespace App\Shared\Infrastructure\Repository\Persistence\Doctrine\CustomType;

use App\Shared\Domain\ValueObject\IntegerValueObject;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

class IntegerValueObjectType extends IntegerType
{

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if (is_null($value)) {
            return null;
        }

        return is_integer($value) ? $value : $value->value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        if (is_null($value)) {
            return null;
        }

        return IntegerValueObject::fromInt((int)$value);
    }

}