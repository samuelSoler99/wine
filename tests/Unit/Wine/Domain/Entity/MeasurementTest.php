<?php

namespace App\Tests\Unit\Wine\Domain\Entity;

use App\Tests\Mother\Shared\Domain\ValueObject\IntegerValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\StringValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Wine\Domain\Entity\Measurement;
use PHPUnit\Framework\TestCase;

class MeasurementTest extends TestCase
{
    public function testInstantiate(): void
    {
        $uuid = UuidMother::random();
        $idSensor = UuidMother::random();
        $idWine = UuidMother::random();
        $color = StringValueObjectMother::random();
        $year = IntegerValueObjectMother::random(4);
        $temperature = IntegerValueObjectMother::random(2);
        $graduation = IntegerValueObjectMother::random(2);
        $pH = IntegerValueObjectMother::random(2);

        $measurement = Measurement::instantiate(
            $uuid,
            $idSensor,
            $idWine,
            $color,
            $year,
            $temperature,
            $graduation,
            $pH
        );

        $this->assertInstanceOf(Measurement::class, $measurement);
        $this->assertEquals($uuid, $measurement->id());
        $this->assertEquals($idSensor, $measurement->idSensor());
        $this->assertEquals($idWine, $measurement->idWine());
        $this->assertEquals($color, $measurement->color());
        $this->assertEquals($year, $measurement->year());
        $this->assertEquals($temperature, $measurement->temperature());
        $this->assertEquals($graduation, $measurement->graduation());
        $this->assertEquals($pH, $measurement->pH());
    }
}