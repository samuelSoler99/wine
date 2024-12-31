<?php

namespace App\Tests\Unit\Wine\Domain\Service;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Tests\Mother\Wine\Domain\Entity\UserMother;
use App\Tests\Unit\Wine\Infrastructure\PhpUnit\WineModuleUnitTestCase;
use App\Wine\Domain\Exception\UserNotFound;
use App\Wine\Domain\Service\GetOneUserByCriteria;

class GetOneUserByCriteriaTest extends WineModuleUnitTestCase
{
    private GetOneUserByCriteria $service;

    protected function setUp(): void
    {
        $this->service = new GetOneUserByCriteria(
            $this->userRepository()
        );
    }

    public function testGetOneUserByCriteria(): void
    {
        $user = UserMother::random();
        $this->shouldUserRepositoryFindOneBy($user);

        $foundUser = $this->service->execute(
            Criteria::create(
                Filters::fromValues(
                    [
                        'email' => 'test@test.com',
                        'password' => 'test',
                    ]
                )
            )
        );

        $this->assertEquals($user->id()->value, $foundUser->id()->value);
    }

    public function testGetOneUserByCriteriaException(): void
    {
        $this->expectException(UserNotFound::class);
        $this->shouldUserRepositoryFindOneBy(null);
        $this->service->execute(
            Criteria::create(
                Filters::fromValues(
                    [
                        'email' => 'test@test.com',
                        'password' => 'test',
                    ]
                )
            )
        );
    }
}