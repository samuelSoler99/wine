<?php

namespace App\Tests\Unit\Wine\Domain\Service;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\ValueObject\StringValueObject;
use App\Tests\Mother\Wine\Domain\Entity\WineMother;
use App\Tests\Unit\Wine\Infrastructure\PhpUnit\WineModuleUnitTestCase;
use App\Wine\Domain\Exception\WineNotFound;
use App\Wine\Domain\Service\GetOneWineByCriteria;

class GetOneWineByCriteriaTest extends WineModuleUnitTestCase
{
    private GetOneWineByCriteria $service;

    protected function setUp(): void
    {
        $this->service = new GetOneWineByCriteria(
            $this->wineRepository()
        );
    }

    public function testGetOneWineByCriteria(): void
    {
        $wine = WineMother::random();
        $this->shouldWineRepositoryFindOneBy($wine);

        $foundWine = $this->service->execute(
            Criteria::create(
                Filters::fromValues(
                    [
                        'name' => StringValueObject::fromString('testName'),
                    ]
                )
            )
        );

        $this->assertEquals($foundWine, $wine);
    }

    public function testGetOneWineByCriteriaException(): void
    {
        $this->expectException(WineNotFound::class);
        $this->shouldWineRepositoryFindOneBy(null);
        $this->service->execute(
            Criteria::create(
                Filters::fromValues(
                    [
                        'name' => StringValueObject::fromString('testName'),
                    ]
                )
            )
        );
    }
}