<?php

namespace App\Wine\Application\Command;

class CreateSensor
{
    public function __construct(
        public string $name,
    ) {
    }
}