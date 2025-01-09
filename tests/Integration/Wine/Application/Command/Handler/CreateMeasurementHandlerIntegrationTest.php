<?php

namespace App\Tests\Integration\Wine\Application\Command\Handler;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\ValueObject\IntegerValueObject;
use App\Tests\Fixtures\Wine\Infrastructure\SensorFixture;
use App\Tests\Fixtures\Wine\Infrastructure\WineFixture;
use App\Tests\Integration\Wine\Infrastructure\PhpUnit\WineIntegrationTestCase;
use App\Tests\Mother\Wine\Application\Command\CreateMeasurementMother;
use App\Wine\Application\Command\Handler\CreateMeasurementHandler;
use App\Wine\Domain\Entity\Measurement;
use App\Wine\Domain\Exception\SensorNotFound;
use App\Wine\Domain\Exception\WineNotFound;

class CreateMeasurementHandlerIntegrationTest extends WineIntegrationTestCase
{
    private CreateMeasurementHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = $this->service(CreateMeasurementHandler::class);
    }

    public function testHandle(): void
    {
        $idWine = WineFixture::WINE_1_ID;
        $idSensor = SensorFixture::SENSOR_1_ID;
        $color = 'yellow';
        $year = 1199;
        $temperature = 22;
        $graduation = 13;
        $ph = 3;

        $this->handler->handle(
            CreateMeasurementMother::create(
                $idSensor,
                $idWine,
                $color,
                $year,
                $temperature,
                $graduation,
                $ph
            )
        );

        $foundMeasurements = $this->measurementRepository()->findOneBy(
            Criteria::create(
                Filters::fromValues(
                    [
                        'year' => IntegerValueObject::fromInt($year),
                    ]
                )
            )
        );

        $this->assertInstanceOf(Measurement::class, $foundMeasurements);
        $this->assertEquals($idSensor, $foundMeasurements->idSensor()->value);
        $this->assertEquals($idWine, $foundMeasurements->idWine()->value);
        $this->assertEquals($year, $foundMeasurements->year()->value);
    }

    public function testDontCreateMeasurement(): void
    {
        $this->expectException(WineNotFound::class);
        $idWine = 'afb59190-4deb-11ed-bdc3-0242ac120008';
        $idSensor = SensorFixture::SENSOR_1_ID;
        $color = 'yellow';
        $year = 1199;
        $temperature = 22;
        $graduation = 13;
        $ph = 3;

        $this->handler->handle(
            CreateMeasurementMother::create(
                $idSensor,
                $idWine,
                $color,
                $year,
                $temperature,
                $graduation,
                $ph
            )
        );
        $foundMeasurements = $this->measurementRepository()->findOneBy(
            Criteria::create(
                Filters::fromValues(
                    [
                        'year' => IntegerValueObject::fromInt($year),
                    ]
                )
            )
        );

        $this->assertEquals(null, $foundMeasurements);
    }

    public function testDontCreateMeasurementWrongSensor(): void
    {
        $this->expectException(SensorNotFound::class);
        $idWine = WineFixture::WINE_1_ID;
        $idSensor = 'afb59190-4deb-11ed-bdc3-0242ac120008';
        $color = 'yellow';
        $year = 1199;
        $temperature = 22;
        $graduation = 13;
        $ph = 3;

        $this->handler->handle(
            CreateMeasurementMother::create(
                $idSensor,
                $idWine,
                $color,
                $year,
                $temperature,
                $graduation,
                $ph
            )
        );
        $foundMeasurements = $this->measurementRepository()->findOneBy(
            Criteria::create(
                Filters::fromValues(
                    [
                        'year' => IntegerValueObject::fromInt($year),
                    ]
                )
            )
        );

        $this->assertEquals(null, $foundMeasurements);
    }
}