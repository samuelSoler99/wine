<?php

namespace App\Tests\Unit\Wine\Application\Command\Handler;

use App\Shared\Domain\ValueObject\StringValueObject;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Tests\Mother\Wine\Application\Command\ListSensorsShortedByNameMother;
use App\Tests\Mother\Wine\Domain\Entity\SensorMother;
use App\Tests\Unit\Wine\Infrastructure\PhpUnit\WineModuleUnitTestCase;
use App\Wine\Application\Command\Handler\ListSensorsShortedByNameHandler;
use App\Wine\Domain\Entity\Sensor;

class ListSensorsShortedByNameHandlerTest extends WineModuleUnitTestCase
{
    private ListSensorsShortedByNameHandler $handler;

    public function setUp(): void
    {
        parent::setUp();
        $this->handler = new ListSensorsShortedByNameHandler(
            $this->sensorRepository()
        );
    }

    public function testHandler(): void
    {
        $secondSensorName = 'b test name';
        $lastSensorName = 'z test name';
        $firstSensorName = 'a test name';
        $sensors = [
            (new SensorMother())->randomize()
                ->withUuid(UuidMother::random())
                ->withName(StringValueObject::fromString($firstSensorName))
                ->instantiate(),
            (new SensorMother())->randomize()
                ->withUuid(UuidMother::random())
                ->withName(StringValueObject::fromString($secondSensorName))
                ->instantiate(),
            (new SensorMother())->randomize()
                ->withUuid(UuidMother::random())
                ->withName(StringValueObject::fromString($lastSensorName))
                ->instantiate(),
        ];
        $this->shouldSensorRepositoryFindAllOrderedByName($sensors);
        $sensors = $this->handler->handle(ListSensorsShortedByNameMother::random());

        $this->assertCount(3, $sensors);
        $this->assertContainsOnlyInstancesOf(Sensor::class, $sensors);
    }
}