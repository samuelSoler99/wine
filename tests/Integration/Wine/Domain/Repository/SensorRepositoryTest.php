<?php

namespace App\Tests\Integration\Wine\Domain\Repository;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\ValueObject\StringValueObject;
use App\Tests\Fixtures\Wine\Infrastructure\SensorFixture;
use App\Tests\Integration\Wine\Infrastructure\PhpUnit\SensorRepositoryIntegrationTestCase;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Tests\Mother\Wine\Domain\Entity\SensorMother;
use App\Wine\Domain\Entity\Sensor;

class SensorRepositoryTest extends SensorRepositoryIntegrationTestCase
{
    public function testFind(): void
    {
        $sensor = $this->repository()->find(UuidMother::create(SensorFixture::SENSOR_1_ID));
        $this->assertInstanceOf(Sensor::class, $sensor);
        $this->assertEquals(SensorFixture::SENSOR_1_NAME, $sensor->name()->value);
    }

    public function testSave(): void
    {
        $sensor = SensorMother::random();
        $this->repository()->save($sensor);
        $foundSensor = $this->repository()->find($sensor->id());
        $this->assertNotNull($foundSensor);
        $this->assertInstanceOf(Sensor::class, $foundSensor);
        $this->repository()->delete($sensor);
    }

    public function testFindOneBy(): void
    {
        $sensor = $this->repository()->findOneBy(
            Criteria::create(
                Filters::fromValues([
                    'name' => StringValueObject::fromString(SensorFixture::SENSOR_1_NAME)
                ])
            )
        );

        $this->assertInstanceOf(Sensor::class, $sensor);
        $this->assertEquals(SensorFixture::SENSOR_1_ID, $sensor->id()->value);
    }

    public function finAllOrderedByName(): void
    {
        $sensorsByName = $this->repository()->findAllOrderedByName();
        $this->assertNotEmpty($sensorsByName);
        $this->assertEquals(SensorFixture::SENSOR_2_NAME, $sensorsByName[0]->name()->value);
        $this->assertEquals(SensorFixture::SENSOR_3_NAME, $sensorsByName[0]->name()->value);
        $this->assertEquals(SensorFixture::SENSOR_1_NAME, $sensorsByName[0]->name()->value);
    }
}