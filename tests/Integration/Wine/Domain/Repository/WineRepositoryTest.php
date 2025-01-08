<?php

namespace App\Tests\Integration\Wine\Domain\Repository;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\ValueObject\StringValueObject;
use App\Tests\Fixtures\Wine\Infrastructure\WineFixture;
use App\Tests\Integration\Wine\Infrastructure\PhpUnit\WineRepositoryIntegrationTestCase;
use App\Tests\Mother\Wine\Domain\Entity\WineMother;
use App\Wine\Domain\Entity\Wine;

class WineRepositoryTest extends WineRepositoryIntegrationTestCase
{
    public function testFindAll(): void
    {
        $wines = $this->repository()->findAll();
        foreach ($wines as $wine) {
            $this->assertInstanceOf(Wine::class, $wine);
        }

        $this->assertCount(2, $wines);
    }

    public function testFindOneBy(): void
    {
        $wine = $this->repository()->findOneBy(
            Criteria::create(
                Filters::fromValues([
                    'name' => StringValueObject::fromString(WineFixture::WINE_1_NAME)
                ])
            )
        );

        $this->assertInstanceOf(Wine::class, $wine);
        $this->assertEquals(WineFixture::WINE_1_NAME, $wine->name()->value);
    }

    public function testSave(): void
    {
        $wine = WineMother::random();
        $this->repository()->save($wine);
        $foundWine = $this->repository()->findOneBy(
            Criteria::create(
                Filters::fromValues([
                    'id' => $wine->id()
                ])
            )
        );

        $this->assertEquals($wine, $foundWine);
    }
}