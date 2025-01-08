<?php

namespace App\Wine\Domain\ViewModel;

use App\Wine\Domain\Entity\Measurement;

class MeasurementView
{
    public function __construct(
        private string $id,
        private string $idSensor,
        private string $idWine,
        private string $color,
        private int $year,
        private int $temperature,
        private int $graduation,
        private int $pH,
    ) {
    }

    public static function create(Measurement $measurement): self
    {
        return new static(
            $measurement->id()->value,
            $measurement->idSensor()->value,
            $measurement->idWine()->value,
            $measurement->color()->value,
            $measurement->year()->value,
            $measurement->temperature()->value,
            $measurement->graduation()->value,
            $measurement->pH()->value,
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function idSensor(): string
    {
        return $this->idSensor;
    }

    public function idWine(): string
    {
        return $this->idWine;
    }

    public function color(): string
    {
        return $this->color;
    }

    public function year(): int
    {
        return $this->year;
    }

    public function temperature(): int
    {
        return $this->temperature;
    }

    public function graduation(): int
    {
        return $this->graduation;
    }

    public function pH(): int
    {
        return $this->pH;
    }
}