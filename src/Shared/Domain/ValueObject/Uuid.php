<?php

namespace App\Shared\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    public function __construct(public string $value)
    {
        $this->ensureIsValidUuid($value);
    }

    public static function fromString(string $aggregateId): self
    {
        return new static($aggregateId);
    }

    public static function random(): self
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    private function ensureIsValidUuid(string $id): void
    {
        if (!RamseyUuid::isValid($id)) {
            throw new InvalidArgumentException('Error in the request, Uuid format is invalid', 403);
        }
    }

    public function equals(Uuid $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}