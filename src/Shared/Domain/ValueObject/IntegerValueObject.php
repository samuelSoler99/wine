<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exception\InvalidIntValue;

class IntegerValueObject
{
    protected function __construct(public int $value)
    {
    }

    public static function fromInt(?int $value): ?self
    {
        if (is_null($value)) {
            return null;
        }

        return new static($value);
    }

    public static function fromString(?string $idString): ?self
    {
        if ($idString === null) {
            return null;
        }

        if (!ctype_digit($idString)) {
            throw new InvalidIntValue('Invalid integer value', 400);
        }

        $id = (int)$idString;
        return new static($id);
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(IntegerValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function __toString()
    {
        return strval( $this->value() );
    }

    public function toMoney(): string
    {
        return number_format(($this->value/100), 2);
    }
}