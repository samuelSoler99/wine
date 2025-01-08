<?php

namespace App\Wine\Domain\Entity;

use App\Shared\Domain\ValueObject\IntegerValueObject;
use App\Shared\Domain\ValueObject\StringValueObject;
use App\Shared\Domain\ValueObject\Uuid;

class Measurement
{
    private function __construct(
        private Uuid $id,
        private Uuid $idSensor,
        private Uuid $idWine,
        private StringValueObject $color,
        private IntegerValueObject $year,
        private IntegerValueObject $temperature,
        //todo para agilizar, los genero como Int en lugar de float, habria que cambiar el ph y la graduation
        private IntegerValueObject $graduation,
        private IntegerValueObject $pH,
    ) {
    }

    public static function instantiate(
        Uuid $id,
        Uuid $idSensor,
        Uuid $idWine,
        StringValueObject $color,
        IntegerValueObject $year,
        IntegerValueObject $temperature,
        IntegerValueObject $graduation,
        IntegerValueObject $pH,
    ) {
        return new self($id, $idSensor, $idWine, $color, $year, $temperature, $graduation, $pH);
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function idSensor(): Uuid
    {
        return $this->idSensor;
    }

    public function idWine(): Uuid
    {
        return $this->idWine;
    }

    public function color(): StringValueObject
    {
        return $this->color;
    }

    public function year(): IntegerValueObject
    {
        return $this->year;
    }

    public function temperature(): IntegerValueObject
    {
        return $this->temperature;
    }

    public function graduation(): IntegerValueObject
    {
        return $this->graduation;
    }

    public function pH(): IntegerValueObject
    {
        return $this->pH;
    }
}