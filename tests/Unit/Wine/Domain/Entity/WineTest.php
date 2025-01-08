<?php

namespace App\Tests\Unit\Wine\Domain\Entity;

use App\Tests\Mother\Shared\Domain\ValueObject\IntegerValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\StringValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Wine\Domain\Entity\Wine;
use PHPUnit\Framework\TestCase;

class WineTest extends TestCase
{
    public function testInstantiate(): void
    {
        $uuid = UuidMother::random();
        $name = StringValueObjectMother::random();
        $year = IntegerValueObjectMother::random(4);

        $wine = Wine::instantiate(
            $uuid,
            $name,
            $year
        );

        $this->assertInstanceOf(Wine::class, $wine);
        $this->assertEquals($uuid, $wine->id());
        $this->assertEquals($name, $wine->name());
        $this->assertEquals($year, $wine->year());
    }
}