<?php

namespace App\Tests\Integration\Wine\Domain\Repository;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\ValueObject\StringValueObject;
use App\Tests\Fixtures\Wine\Infrastructure\MeasurementFixture;
use App\Tests\Fixtures\Wine\Infrastructure\WineFixture;
use App\Tests\Integration\Wine\Infrastructure\PhpUnit\MeasurementRepositoryIntegrationTestCase;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Tests\Mother\Wine\Domain\Entity\MeasurementMother;
use App\Wine\Domain\Entity\Measurement;

class MeasurementRepositoryTest extends MeasurementRepositoryIntegrationTestCase
{
    public function testFindOneBy(): void
    {
        $measurement = $this->repository()->findOneBy(
            Criteria::create(
                Filters::fromValues([
                    'color' => StringValueObject::fromString(MeasurementFixture::MEASUREMENT_1_COLOR)
                ])
            )
        );

        $this->assertInstanceOf(Measurement::class, $measurement);
        $this->assertEquals(MeasurementFixture::MEASUREMENT_1_COLOR, $measurement->color()->value);
    }

    public function testFindBy(): void
    {
        $wineIds = [UuidMother::create(WineFixture::WINE_1_ID), UuidMother::create(WineFixture::WINE_2_ID)];
        $measurements = $this->repository()->findBy(
            Criteria::create(
                Filters::fromValues([
                    'idWine' => $wineIds
                ])
            )
        );

        $this->assertCount(3, $measurements);
        foreach ($measurements as $measurement) {
            $this->assertInstanceOf(Measurement::class, $measurement);
        }
    }

    public function testSave(): void
    {
        $measurement = MeasurementMother::random();
        $this->repository()->save($measurement);
        $foundMeasurement = $this->repository()->findOneBy(
            Criteria::create(
                Filters::fromValues([
                    'id' => $measurement->id()
                ])
            )
        );

        $this->assertEquals($measurement, $foundMeasurement);
    }
}