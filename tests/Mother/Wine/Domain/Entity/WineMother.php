<?php

namespace App\Tests\Mother\Wine\Domain\Entity;

use App\Shared\Domain\ValueObject\IntegerValueObject;
use App\Shared\Domain\ValueObject\StringValueObject;
use App\Shared\Domain\ValueObject\Uuid;
use App\Tests\Mother\Shared\Domain\ValueObject\IntegerValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\StringValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Wine\Domain\Entity\Wine;

class WineMother
{
    private Uuid $uuid;
    private StringValueObject $name;
    private IntegerValueObject $year;

    public static function random(): Wine
    {
        return (new WineMother())->randomize()->instantiate();
    }

    public function randomize(): self
    {
        $this->uuid = UuidMother::random();
        $this->name = StringValueObjectMother::random();
        $this->year = IntegerValueObjectMother::random();
        return $this;
    }

    public function withUuid(Uuid $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function withName(StringValueObject $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function withYear(IntegerValueObject $year): self
    {
        $this->year = $year;
        return $this;
    }

    public function instantiate(): Wine
    {
        return Wine::instantiate(
            $this->uuid,
            $this->name,
            $this->year
        );
    }
}