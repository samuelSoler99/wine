<?php

namespace App\Wine\Domain\Service;

use App\Shared\Domain\Criteria\Criteria;
use App\Wine\Domain\Entity\Sensor;
use App\Wine\Domain\Exception\SensorNotFound;
use App\Wine\Domain\Repository\SensorRepository;

class GetOneSensorByCriteria
{
    public function __construct(
        private SensorRepository $sensorRepository
    ) {
    }

    /**
     * @throws SensorNotFound
     */
    public function execute(Criteria $criteria): Sensor
    {
        return $this->sensorRepository->findOneBy($criteria) ?? throw new SensorNotFound('Sensor not found', 404);
    }
}