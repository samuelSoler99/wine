<?php

namespace App\Tests\Fixtures\Wine\Infrastructure;

use App\Shared\Domain\ValueObject\StringValueObject;
use App\Tests\Mother\Shared\Domain\ValueObject\IntegerValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Tests\Mother\Wine\Domain\Entity\WineMother;
use App\Wine\Domain\Repository\WineRepository;

class WineFixture
{
    public const WINE_1_ID = 'afb59190-4deb-11ed-bdc3-0242ac120002';
    public const WINE_1_NAME = 'Wine 1';
    public const WINE_1_YEAR = 2022;

    public const WINE_2_ID = 'afb59190-4deb-11ed-bdc3-0242ac120003';
    public const WINE_2_NAME = 'Wine 2';
    public const WINE_2_YEAR = 2022;

    public function __construct(
        private WineRepository $wineRepository,
    ) {
    }

    public function load(): void
    {
        $this->wineRepository->save(
            (new WineMother())->randomize()
                ->withUuid(UuidMother::create(self::WINE_1_ID))
                ->withName(StringValueObject::fromString(self::WINE_1_NAME))
                ->withYear(IntegerValueObjectMother::create(self::WINE_1_YEAR))
                ->instantiate()
        );

        $this->wineRepository->save(
            (new WineMother())->randomize()
                ->withUuid(UuidMother::create(self::WINE_2_ID))
                ->withName(StringValueObject::fromString(self::WINE_2_NAME))
                ->withYear(IntegerValueObjectMother::create(self::WINE_2_YEAR))
                ->instantiate()
        );
    }

    public function purge(): void
    {
        $this->wineRepository->deleteAll();
    }
}