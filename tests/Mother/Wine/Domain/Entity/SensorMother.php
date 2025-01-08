<?php

namespace App\Tests\Mother\Wine\Domain\Entity;

use App\Shared\Domain\ValueObject\StringValueObject;
use App\Shared\Domain\ValueObject\Uuid;
use App\Tests\Mother\Shared\Domain\ValueObject\StringValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Wine\Domain\Entity\Sensor;

class SensorMother
{
    private Uuid $uuid;
    private StringValueObject $name;

    public static function random(): Sensor
    {
        return (new SensorMother())->randomize()->instantiate();
    }

    public function randomize(): self
    {
        $this->uuid = UuidMother::random();
        $this->name = StringValueObjectMother::random();
        return $this;
    }

    public function withUuid(Uuid $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function withName(StringValueObject $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function instantiate(): Sensor
    {
        return Sensor::instantiate(
            $this->uuid,
            $this->name,
        );
    }
}