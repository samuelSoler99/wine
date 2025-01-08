<?php

namespace App\Wine\Domain\Entity;

use App\Shared\Domain\ValueObject\IntegerValueObject;
use App\Shared\Domain\ValueObject\StringValueObject;
use App\Shared\Domain\ValueObject\Uuid;

class Wine
{
    public function __construct(
        private Uuid $id,
        private StringValueObject $name,
        private IntegerValueObject $year
    ) {
    }

    public static function instantiate(
        Uuid $id,
        StringValueObject $name,
        IntegerValueObject $year
    ): self {
        return new self($id, $name, $year);
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function name(): StringValueObject
    {
        return $this->name;
    }

    public function year(): IntegerValueObject
    {
        return $this->year;
    }
}