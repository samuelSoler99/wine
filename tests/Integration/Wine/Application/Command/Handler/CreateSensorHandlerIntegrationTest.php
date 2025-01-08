<?php

namespace App\Tests\Integration\Wine\Application\Command\Handler;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\ValueObject\StringValueObject;
use App\Tests\Integration\Wine\Infrastructure\PhpUnit\WineIntegrationTestCase;
use App\Tests\Mother\Wine\Application\Command\CreateSensorMother;
use App\Wine\Application\Command\Handler\CreateSensorHandler;
use App\Wine\Domain\Entity\Sensor;
use App\Wine\Domain\Exception\SensorAlreadyExists;

class CreateSensorHandlerIntegrationTest extends WineIntegrationTestCase
{
    private CreateSensorHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = $this->service(CreateSensorHandler::class);
    }

    public function testHandle(): void
    {
        $sensorName = 'test sensor Name';
        $this->handler->handle(CreateSensorMother::create($sensorName));
        $foundSensor = $this->sensorRepository()->findOneBy(
            Criteria::create(
                Filters::fromValues(
                    [
                        'name' => StringValueObject::fromString($sensorName),
                    ]
                )
            )
        );

        $this->assertInstanceOf(Sensor::class, $foundSensor);
        $this->assertEquals($sensorName, $foundSensor->name()->value);

    }

    public function testHandleWithAlreadyExistingName(): void
    {
        $this->expectException(SensorAlreadyExists::class);
        $sensorName = 'zName';
        $this->handler->handle(CreateSensorMother::create($sensorName));
    }
}