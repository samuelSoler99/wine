<?php

namespace App\Tests\Fixtures\Wine\Infrastructure;

use App\Tests\Mother\Shared\Domain\ValueObject\IntegerValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\StringValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Tests\Mother\Wine\Domain\Entity\MeasurementMother;
use App\Wine\Domain\Repository\MeasurementRepository;

class MeasurementFixture
{
    public const MEASUREMENT_1_ID = 'afb59190-4deb-11ed-bdc3-0242ac120002';
    public const MEASUREMENT_1_COLOR = 'yellow';
    public const MEASUREMENT_1_YEAR = 2022;
    public const MEASUREMENT_1_TEMPERATURE = 26;
    public const MEASUREMENT_1_GRADUATION = 15;
    public const MEASUREMENT_1_PH = 3;

    public const MEASUREMENT_2_ID = 'afb59190-4deb-11ed-bdc3-0242ac120003';
    public const MEASUREMENT_2_COLOR = 'blue';
    public const MEASUREMENT_2_YEAR = 2023;
    public const MEASUREMENT_2_TEMPERATURE = 23;
    public const MEASUREMENT_2_GRADUATION = 13;
    public const MEASUREMENT_2_PH = 2;

    public const MEASUREMENT_3_ID = 'afb59190-4deb-11ed-bdc3-0242ac120004';
    public const MEASUREMENT_3_COLOR = 'blue';
    public const MEASUREMENT_3_YEAR = 2023;
    public const MEASUREMENT_3_TEMPERATURE = 23;
    public const MEASUREMENT_3_GRADUATION = 13;
    public const MEASUREMENT_3_PH = 2;

    public function __construct(
        private MeasurementRepository $measurementRepository,
    ) {
    }

    public function load(): void
    {
        $this->measurementRepository->save(
            (new MeasurementMother())->randomize()
                ->withUuid(UuidMother::create(self::MEASUREMENT_1_ID))
                ->withIdSensor(UuidMother::create(SensorFixture::SENSOR_1_ID))
                ->withIdWine(UuidMother::create(WineFixture::WINE_1_ID))
                ->withColor(StringValueObjectMother::create(self::MEASUREMENT_1_COLOR))
                ->withYear(IntegerValueObjectMother::create(self::MEASUREMENT_1_YEAR))
                ->withTemperature(IntegerValueObjectMother::create(self::MEASUREMENT_1_TEMPERATURE))
                ->withGraduation(IntegerValueObjectMother::create(self::MEASUREMENT_1_GRADUATION))
                ->withPH(IntegerValueObjectMother::create(self::MEASUREMENT_1_PH))
                ->instantiate()
        );

        $this->measurementRepository->save(
            (new MeasurementMother())->randomize()
                ->withUuid(UuidMother::create(self::MEASUREMENT_2_ID))
                ->withIdSensor(UuidMother::create(SensorFixture::SENSOR_1_ID))
                ->withIdWine(UuidMother::create(WineFixture::WINE_1_ID))
                ->withColor(StringValueObjectMother::create(self::MEASUREMENT_2_COLOR))
                ->withYear(IntegerValueObjectMother::create(self::MEASUREMENT_2_YEAR))
                ->withTemperature(IntegerValueObjectMother::create(self::MEASUREMENT_2_TEMPERATURE))
                ->withGraduation(IntegerValueObjectMother::create(self::MEASUREMENT_2_GRADUATION))
                ->withPH(IntegerValueObjectMother::create(self::MEASUREMENT_2_PH))
                ->instantiate()
        );

        $this->measurementRepository->save(
            (new MeasurementMother())->randomize()
                ->withUuid(UuidMother::create(self::MEASUREMENT_3_ID))
                ->withIdSensor(UuidMother::create(SensorFixture::SENSOR_3_ID))
                ->withIdWine(UuidMother::create(WineFixture::WINE_2_ID))
                ->withColor(StringValueObjectMother::create(self::MEASUREMENT_3_COLOR))
                ->withYear(IntegerValueObjectMother::create(self::MEASUREMENT_3_YEAR))
                ->withTemperature(IntegerValueObjectMother::create(self::MEASUREMENT_3_TEMPERATURE))
                ->withGraduation(IntegerValueObjectMother::create(self::MEASUREMENT_3_GRADUATION))
                ->withPH(IntegerValueObjectMother::create(self::MEASUREMENT_3_PH))
                ->instantiate()
        );
    }

    public function purge(): void
    {
        $this->measurementRepository->deleteAll();
    }
}