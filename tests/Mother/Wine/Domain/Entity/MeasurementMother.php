<?php

namespace App\Tests\Mother\Wine\Domain\Entity;

use App\Shared\Domain\ValueObject\IntegerValueObject;
use App\Shared\Domain\ValueObject\StringValueObject;
use App\Shared\Domain\ValueObject\Uuid;
use App\Tests\Mother\Shared\Domain\ValueObject\IntegerValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\StringValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Wine\Domain\Entity\Measurement;

class MeasurementMother
{
    private Uuid $uuid;
    private Uuid $idSensor;
    private Uuid $idWine;
    private StringValueObject $color;
    private IntegerValueObject $year;
    private IntegerValueObject $temperature;
    private IntegerValueObject $graduation;
    private IntegerValueObject $pH;

    public static function random(): Measurement
    {
        return (new MeasurementMother())->randomize()->instantiate();
    }

    public function randomize(): self
    {
        $this->uuid = UuidMother::random();
        $this->idSensor = UuidMother::random();
        $this->idWine = UuidMother::random();
        $this->color = StringValueObjectMother::random();
        $this->year = IntegerValueObjectMother::random();
        $this->temperature = IntegerValueObjectMother::random();
        $this->graduation = IntegerValueObjectMother::random();
        $this->pH = IntegerValueObjectMother::random();
        return $this;
    }

    public function withUuid(Uuid $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function withIdSensor(Uuid $idSensor): self
    {
        $this->idSensor = $idSensor;
        return $this;
    }

    public function withIdWine(Uuid $idWine): self
    {
        $this->idWine = $idWine;
        return $this;
    }

    public function withName(StringValueObject $name): self
    {
        return $this;
    }

    public function withColor(StringValueObject $color): self
    {
        $this->color = $color;
        return $this;
    }

    public function withYear(IntegerValueObject $year): self
    {
        $this->year = $year;
        return $this;
    }

    public function withTemperature(IntegerValueObject $temperature): self
    {
        $this->temperature = $temperature;
        return $this;
    }

    public function withGraduation(IntegerValueObject $graduation): self
    {
        $this->graduation = $graduation;
        return $this;
    }

    public function withPH(IntegerValueObject $ph): self
    {
        $this->pH = $ph;
        return $this;
    }

    public function instantiate(): Measurement
    {
        return Measurement::instantiate(
            $this->uuid,
            $this->idSensor,
            $this->idWine,
            $this->color,
            $this->year,
            $this->temperature,
            $this->graduation,
            $this->pH
        );
    }
}