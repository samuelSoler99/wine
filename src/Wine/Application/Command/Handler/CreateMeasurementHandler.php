<?php

namespace App\Wine\Application\Command\Handler;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\ValueObject\IntegerValueObject;
use App\Shared\Domain\ValueObject\StringValueObject;
use App\Shared\Domain\ValueObject\Uuid;
use App\Wine\Application\Command\CreateMeasurement;
use App\Wine\Domain\Entity\Measurement;
use App\Wine\Domain\Exception\SensorNotFound;
use App\Wine\Domain\Exception\WineNotFound;
use App\Wine\Domain\Repository\MeasurementRepository;
use App\Wine\Domain\Service\GetOneSensorByCriteria;
use App\Wine\Domain\Service\GetOneWineByCriteria;

class CreateMeasurementHandler
{
    public function __construct(
        private GetOneSensorByCriteria $getOneSensorByCriteria,
        private GetOneWineByCriteria $getOneWineByCriteria,
        private MeasurementRepository $measurementRepository,
    ) {
    }

    public function handle(CreateMeasurement $command)
    {
            $this->getOneSensorByCriteria->execute(
                Criteria::create(
                    Filters::fromValues([
                        'id' => Uuid::fromString($command->idSensor)
                    ])
                )
            );

            $this->getOneWineByCriteria->execute(
                Criteria::create(
                    Filters::fromValues([
                        'id' => Uuid::fromString($command->idWine)
                    ])
                )
            );

            $this->measurementRepository->save(
                Measurement::instantiate(
                    Uuid::random(),
                    Uuid::fromString($command->idSensor),
                    Uuid::fromString($command->idWine),
                    StringValueObject::fromString($command->color),
                    IntegerValueObject::fromInt($command->year),
                    IntegerValueObject::fromInt($command->temperature),
                    IntegerValueObject::fromInt($command->graduation),
                    IntegerValueObject::fromInt($command->pH),
                )
            );
    }
}