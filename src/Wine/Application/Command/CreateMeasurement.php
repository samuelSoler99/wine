<?php

namespace App\Wine\Application\Command;

class CreateMeasurement
{
    public function __construct(
        public string $idSensor,
        public string $idWine,
        public string $color,
        public int $year,
        public int $temperature,
        public int $graduation,
        public int $pH,
    ) {
    }
}