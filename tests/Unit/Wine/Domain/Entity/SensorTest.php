<?php

namespace App\Tests\Unit\Wine\Domain\Entity;

use App\Tests\Mother\Shared\Domain\ValueObject\StringValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Wine\Domain\Entity\Sensor;
use PHPUnit\Framework\TestCase;

class SensorTest extends TestCase
{
    public function testInstantiate(): void
    {
        $uuid = UuidMother::random();
        $name = StringValueObjectMother::random();

        $user = Sensor::instantiate(
            $uuid,
            $name,
        );

        $this->assertInstanceOf(Sensor::class, $user);
        $this->assertEquals($uuid, $user->id());
        $this->assertEquals($name, $user->name());
    }
}