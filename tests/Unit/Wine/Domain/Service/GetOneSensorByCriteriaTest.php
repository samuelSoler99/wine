<?php

namespace App\Tests\Unit\Wine\Domain\Service;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\ValueObject\StringValueObject;
use App\Tests\Mother\Wine\Domain\Entity\SensorMother;
use App\Tests\Unit\Wine\Infrastructure\PhpUnit\WineModuleUnitTestCase;
use App\Wine\Domain\Exception\SensorNotFound;
use App\Wine\Domain\Service\GetOneSensorByCriteria;

class GetOneSensorByCriteriaTest extends WineModuleUnitTestCase
{
    private GetOneSensorByCriteria $service;

    protected function setUp(): void
    {
        $this->service = new GetOneSensorByCriteria(
            $this->sensorRepository()
        );
    }

    public function testGetOneSensorByCriteria(): void
    {
        $sensor = SensorMother::random();
        $this->shouldSensorRepositoryFindOneBy($sensor);

        $foundSensor = $this->service->execute(
            Criteria::create(
                Filters::fromValues(
                    [
                        'name' => StringValueObject::fromString('testName'),
                    ]
                )
            )
        );

        $this->assertEquals($sensor, $foundSensor);
    }

    public function testGetOneSensorByCriteriaException(): void
    {
        $this->expectException(SensorNotFound::class);
        $this->shouldSensorRepositoryFindOneBy(null);
        $this->service->execute(
            Criteria::create(
                Filters::fromValues(
                    [
                        'name' => StringValueObject::fromString('testName'),
                    ]
                )
            )
        );
    }

}