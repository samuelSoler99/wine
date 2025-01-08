<?php

namespace App\Wine\Application\Command\Handler;

use App\Wine\Application\Command\ListSensorsShortedByName;
use App\Wine\Domain\Entity\Sensor;
use App\Wine\Domain\Repository\SensorRepository;

class ListSensorsShortedByNameHandler
{
    public function __construct(
        private SensorRepository $sensorRepository,
    ) {
    }

    /**
     * @return Sensor[]
     */
    public function handle(ListSensorsShortedByName $command): array
    {
        return $this->sensorRepository->findAllOrderedByName();
    }
}