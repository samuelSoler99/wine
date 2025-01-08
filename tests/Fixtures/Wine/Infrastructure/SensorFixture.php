<?php

namespace App\Tests\Fixtures\Wine\Infrastructure;

use App\Shared\Domain\ValueObject\StringValueObject;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Tests\Mother\Wine\Domain\Entity\SensorMother;
use App\Wine\Domain\Repository\SensorRepository;

class SensorFixture
{
    public const SENSOR_1_ID = 'afb59190-4deb-11ed-bdc3-0242ac120002';
    public const SENSOR_1_NAME = 'zName';

    public const SENSOR_2_ID = 'afb59190-4deb-11ed-bdc3-0242ac120003';
    public const SENSOR_2_NAME = 'aName';

    public const SENSOR_3_ID = 'afb59190-4deb-11ed-bdc3-0242ac120004';
    public const SENSOR_3_NAME = 'cName';

    public function __construct(
        private SensorRepository $sensorRepository,
    ) {
    }

    public function load()
    {
        $this->sensorRepository->save(
            (new SensorMother())->randomize()
                ->withUuid(UuidMother::create(self::SENSOR_1_ID))
                ->withName(StringValueObject::fromString(self::SENSOR_1_NAME))
                ->instantiate()
        );

        $this->sensorRepository->save(
            (new SensorMother())->randomize()
                ->withUuid(UuidMother::create(self::SENSOR_2_ID))
                ->withName(StringValueObject::fromString(self::SENSOR_2_NAME))
                ->instantiate()
        );

        $this->sensorRepository->save(
            (new SensorMother())->randomize()
                ->withUuid(UuidMother::create(self::SENSOR_3_ID))
                ->withName(StringValueObject::fromString(self::SENSOR_3_NAME))
                ->instantiate()
        );
    }

    public function purge()
    {
        $this->sensorRepository->deleteAll();
    }
}