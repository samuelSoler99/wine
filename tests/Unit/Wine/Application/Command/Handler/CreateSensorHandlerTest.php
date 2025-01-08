<?php

namespace App\Tests\Unit\Wine\Application\Command\Handler;

use App\Tests\Mother\Wine\Application\Command\CreateSensorMother;
use App\Tests\Mother\Wine\Domain\Entity\SensorMother;
use App\Tests\Unit\Wine\Infrastructure\PhpUnit\WineModuleUnitTestCase;
use App\Wine\Application\Command\Handler\CreateSensorHandler;
use App\Wine\Domain\Exception\SensorAlreadyExists;

class CreateSensorHandlerTest extends WineModuleUnitTestCase
{

    private CreateSensorHandler $handler;

    public function setUp(): void
    {
        parent::setUp();
        $this->handler = new CreateSensorHandler(
            $this->getOneSensorByCriteria(),
            $this->sensorRepository()
        );
    }

    public function testHandle(): void
    {
        $createSensorCommand = CreateSensorMother::random();
        $this->shouldGetOneSensorByCriteriaThrowException();
        $this->shouldSensorRepositoryCreate();
        $this->handler->handle($createSensorCommand);
    }

    public function testHandleThrowException(): void
    {
        $this->expectException(SensorAlreadyExists::class);
        $createSensorCommand = CreateSensorMother::random();
        $this->shouldGetOneSensorByCriteria(SensorMother::random());
        $this->handler->handle($createSensorCommand);
    }
}