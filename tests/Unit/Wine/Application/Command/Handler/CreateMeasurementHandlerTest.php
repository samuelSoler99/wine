<?php

namespace App\Tests\Unit\Wine\Application\Command\Handler;

use App\Tests\Mother\Wine\Application\Command\CreateMeasurementMother;
use App\Tests\Mother\Wine\Domain\Entity\SensorMother;
use App\Tests\Mother\Wine\Domain\Entity\WineMother;
use App\Tests\Unit\Wine\Infrastructure\PhpUnit\WineModuleUnitTestCase;
use App\Wine\Application\Command\Handler\CreateMeasurementHandler;
use App\Wine\Domain\Exception\SensorNotFound;
use App\Wine\Domain\Exception\WineNotFound;

class CreateMeasurementHandlerTest extends WineModuleUnitTestCase
{
    private CreateMeasurementHandler $handler;

    public function setUp(): void
    {
        parent::setUp();
        $this->handler = new CreateMeasurementHandler(
            $this->getOneSensorByCriteria(),
            $this->getOneWineByCriteria(),
            $this->measurementRepository()
        );
    }

    public function testHandler(): void
    {
        $createMeasurement = CreateMeasurementMother::random();
        $this->shouldGetOneSensorByCriteria(SensorMother::random());
        $this->shouldGetOneWineByCriteria(WineMother::random());
        $this->shouldMeasurementRepositorySave();
        $this->handler->handle($createMeasurement);
    }

    public function testHandlerWithSensorNotFoundException(): void
    {
        $this->expectException(SensorNotFound::class);
        $createMeasurement = CreateMeasurementMother::random();
        $this->shouldGetOneSensorByCriteriaThrowException();
        $this->handler->handle($createMeasurement);
    }

    public function testHandlerWithWineNotFoundException(): void
    {
        $this->expectException(WineNotFound::class);
        $createMeasurement = CreateMeasurementMother::random();
        $this->shouldGetOneSensorByCriteria(SensorMother::random());
        $this->shouldGetOneWineByCriteriaThrowException();
        $this->handler->handle($createMeasurement);
    }
}