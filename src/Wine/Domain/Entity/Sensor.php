<?php

namespace App\Wine\Domain\Entity;

use App\Shared\Domain\ValueObject\StringValueObject;
use App\Shared\Domain\ValueObject\Uuid;

class Sensor
{
    private function __construct(
        private Uuid $id,
        private StringValueObject $name,
    ) {
    }

    public static function instantiate(
        Uuid $id,
        StringValueObject $name,
    ) {
        return new self($id, $name);
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function name(): StringValueObject
    {
        return $this->name;
    }
}