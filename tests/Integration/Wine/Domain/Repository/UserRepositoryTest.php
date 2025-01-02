<?php

namespace App\Tests\Integration\Wine\Domain\Repository;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\ValueObject\StringValueObject;
use App\Tests\Fixtures\Wine\Infrastructure\UserFixture;
use App\Tests\Integration\Wine\Infrastructure\PhpUnit\UserRepositoryIntegrationTestCase;
use App\Wine\Domain\Entity\User;

class UserRepositoryTest extends UserRepositoryIntegrationTestCase
{
    public function testFindOneBy(): void
    {

        $user = $this->repository()->findOneBy(
            Criteria::create(
                Filters::fromValues([
                    'email' => StringValueObject::fromString(UserFixture::USUARIO_1_EMAIL),
                ])
            )
        );
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(UserFixture::USUARIO_1_ID, $user->id()->value);
    }
}