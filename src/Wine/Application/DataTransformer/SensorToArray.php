<?php

namespace App\Wine\Application\DataTransformer;

use App\Wine\Domain\Entity\Sensor;

class SensorToArray
{
    public function transform(Sensor $sensor): array
    {
        return [
            'id' => $sensor->id()->value,
            'name' => $sensor->name()->value,
        ];
    }
}