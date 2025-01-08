<?php

namespace App\Tests\Unit\Wine\Application\DataTransformer;

use App\Shared\Domain\ValueObject\StringValueObject;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Tests\Mother\Wine\Domain\Entity\SensorMother;
use App\Tests\Unit\Wine\Infrastructure\PhpUnit\WineModuleUnitTestCase;
use App\Wine\Application\DataTransformer\SensorToArray;

class SensorToArrayTest extends WineModuleUnitTestCase
{
    private SensorToArray $sensorToArray;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sensorToArray = new SensorToArray();
    }

        public function testSensorToArray(): void
        {
            $uuid = 'afb59190-4deb-11ed-bdc3-0242ac120009';
            $name = 'test name transformer';

            $sensor = (new SensorMother())->randomize()
                ->withUuid(UuidMother::create($uuid))
                ->withName(StringValueObject::fromString($name))
                ->instantiate();

            $sensorArray = [
                'id' => $uuid,
                'name' => $name,
            ];

            $this->assertEquals($sensorArray, $this->sensorToArray->transform($sensor) );
        }
}