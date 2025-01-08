<?php

namespace App\Wine\Application\Command\Handler;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\ValueObject\StringValueObject;
use App\Shared\Domain\ValueObject\Uuid;
use App\Wine\Application\Command\CreateSensor;
use App\Wine\Domain\Entity\Sensor;
use App\Wine\Domain\Exception\SensorAlreadyExists;
use App\Wine\Domain\Exception\SensorNotFound;
use App\Wine\Domain\Repository\SensorRepository;
use App\Wine\Domain\Service\GetOneSensorByCriteria;

class CreateSensorHandler
{
    public function __construct(
        private GetOneSensorByCriteria $getOneSensorByCriteria,
        private SensorRepository $sensorRepository,
    ) {
    }

    /**
     * @throws SensorAlreadyExists
     */
    public function handle(CreateSensor $command): void
    {
        try {
            $this->getOneSensorByCriteria->execute(
                Criteria::create(
                    Filters::fromValues(
                        [
                            'name' => StringValueObject::fromString($command->name),
                        ],
                    )
                )
            );
            throw new SensorAlreadyExists('There is already existing a sensor with this name', 400);
        } catch (SensorNotFound) {
            $this->createSensor($command);
        }
    }

    private function createSensor(
        CreateSensor $command,
    ): void {
        $sensor = Sensor::instantiate(
            Uuid::random(),
            StringValueObject::fromString($command->name),
        );

        $this->sensorRepository->save($sensor);
    }
}