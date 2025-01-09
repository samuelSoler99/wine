<?php

namespace App\Tests\Unit\Wine\Application\Command\Handler;

use App\Shared\Domain\ValueObject\StringValueObject;
use App\Tests\Mother\Shared\Domain\ValueObject\IntegerValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\StringValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Tests\Mother\Wine\Application\Command\ListWinesMother;
use App\Tests\Mother\Wine\Domain\Entity\MeasurementMother;
use App\Tests\Mother\Wine\Domain\Entity\WineMother;
use App\Tests\Unit\Wine\Infrastructure\PhpUnit\WineModuleUnitTestCase;
use App\Wine\Application\Command\Handler\ListWinesHandler;
use App\Wine\Application\DateMapper\MeasurementsViewByWineIdMapper;
use App\Wine\Application\DateMapper\WinesViewByIdMapper;
use App\Wine\Domain\ViewModel\MeasurementView;
use App\Wine\Domain\ViewModel\WineView;

class ListWinesHandlerTest extends WineModuleUnitTestCase
{
    private ListWinesHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = new ListWinesHandler(
            $this->wineRepository(),
            $this->measurementRepository(),
            new MeasurementsViewByWineIdMapper(),
            new WinesViewByIdMapper()
        );
    }

    public function testHandler(): void
    {
        $listWine = ListWinesMother::random();
        $wines = [
            (new WineMother())->randomize()
                ->withUuid(UuidMother::create('afb59190-4deb-11ed-bdc3-0242ac120001'))
                ->withName(StringValueObject::fromString('wine 1'))
                ->withYear(IntegerValueObjectMother::create(2022))
                ->instantiate(),
            (new WineMother())->randomize()
                ->withUuid(UuidMother::create('afb59190-4deb-11ed-bdc3-0242ac120002'))
                ->withName(StringValueObject::fromString('Wine 2'))
                ->withYear(IntegerValueObjectMother::create(2022))
                ->instantiate()
        ];

        $measurements = $this->generateMeasurements();
        $this->shouldWineRepositoryFindAll($wines);
        $this->shouldMeasurementRepositoryFindBy($measurements);
        $wineViewList = $this->handler->handle($listWine);

        $this->assertCount(2, $wineViewList);
        foreach ($wineViewList as $idWine => $wineView) {
            $this->assertInstanceOf(WineView::class, $wineView);
            $this->assertEquals($wineView->id(), $idWine);
            foreach ($wineView->measurementView() as $measurementView) {
                $this->assertInstanceOf(MeasurementView::class, $measurementView);
                $this->assertEquals($idWine, $measurementView->idWine());
            }
        }
    }

    private function generateMeasurements(): array
    {
        return [
            (new MeasurementMother())->randomize()
                ->withUuid(UuidMother::random())
                ->withIdSensor(UuidMother::create('afb59190-4deb-11ed-bdc3-0242ac120001'))
                ->withIdWine(UuidMother::create('afb59190-4deb-11ed-bdc3-0242ac120001'))
                ->withColor(StringValueObjectMother::create('verde'))
                ->withYear(IntegerValueObjectMother::create(2020))
                ->withTemperature(IntegerValueObjectMother::create(29))
                ->withGraduation(IntegerValueObjectMother::create(15))
                ->withPH(IntegerValueObjectMother::create(3))
                ->instantiate(),
            (new MeasurementMother())->randomize()
                ->withUuid(UuidMother::random())
                ->withIdSensor(UuidMother::create('afb59190-4deb-11ed-bdc3-0242ac120001'))
                ->withIdWine(UuidMother::create('afb59190-4deb-11ed-bdc3-0242ac120001'))
                ->withColor(StringValueObjectMother::create('amarilo'))
                ->withYear(IntegerValueObjectMother::create(2010))
                ->withTemperature(IntegerValueObjectMother::create(24))
                ->withGraduation(IntegerValueObjectMother::create(14))
                ->withPH(IntegerValueObjectMother::create(2))
                ->instantiate(),
            (new MeasurementMother())->randomize()
                ->withUuid(UuidMother::random())
                ->withIdSensor(UuidMother::create('afb59190-4deb-11ed-bdc3-0242ac120001'))
                ->withIdWine(UuidMother::create('afb59190-4deb-11ed-bdc3-0242ac120002'))
                ->withColor(StringValueObjectMother::create('azul'))
                ->withYear(IntegerValueObjectMother::create(2024))
                ->withTemperature(IntegerValueObjectMother::create(22))
                ->withGraduation(IntegerValueObjectMother::create(11))
                ->withPH(IntegerValueObjectMother::create(3))
                ->instantiate(),
            (new MeasurementMother())->randomize()
                ->withUuid(UuidMother::random())
                ->withIdSensor(UuidMother::create('afb59190-4deb-11ed-bdc3-0242ac120002'))
                ->withIdWine(UuidMother::create('afb59190-4deb-11ed-bdc3-0242ac120002'))
                ->withColor(StringValueObjectMother::create('rosa'))
                ->withYear(IntegerValueObjectMother::create(2013))
                ->withTemperature(IntegerValueObjectMother::create(23))
                ->withGraduation(IntegerValueObjectMother::create(13))
                ->withPH(IntegerValueObjectMother::create(1))
                ->instantiate(),
            (new MeasurementMother())->randomize()
                ->withUuid(UuidMother::random())
                ->withIdSensor(UuidMother::create('afb59190-4deb-11ed-bdc3-0242ac120001'))
                ->withIdWine(UuidMother::create('afb59190-4deb-11ed-bdc3-0242ac120002'))
                ->withColor(StringValueObjectMother::create('white'))
                ->withYear(IntegerValueObjectMother::create(2025))
                ->withTemperature(IntegerValueObjectMother::create(33))
                ->withGraduation(IntegerValueObjectMother::create(12))
                ->withPH(IntegerValueObjectMother::create(2))
                ->instantiate(),
        ];
    }
}