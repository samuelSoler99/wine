<?php

namespace App\Tests\Unit\Wine\Infrastructure\PhpUnit;

use App\Tests\Unit\Shared\SharedModuleUnitTestCase;
use App\Wine\Domain\Entity\User;
use App\Wine\Domain\Exception\UserNotFound;
use App\Wine\Domain\Repository\UserRepository;
use App\Wine\Domain\Service\GetOneUserByCriteria;
use Mockery\MockInterface;

class WineModuleUnitTestCase extends SharedModuleUnitTestCase
{
    private UserRepository $userRepository;
    private GetOneUserByCriteria $getOneUserByCriteria;

    public function userRepository(): UserRepository|MockInterface
    {
        if (empty($this->userRepository)) {
            $this->userRepository = $this->mock(UserRepository::class);
        }

        return $this->userRepository;
    }

    public function shouldUserRepositoryFindOneBy(?User $user): void
    {
        $this->userRepository()
            ->shouldReceive('findOneBy')
            ->once()
            ->andReturn($user);
    }

    public function getOneUserByCriteria(): GetOneUserByCriteria|MockInterface
    {
        if (empty($this->getOneUserByCriteria)) {
            $this->getOneUserByCriteria = $this->mock(GetOneUserByCriteria::class);
        }
        return $this->getOneUserByCriteria;
    }

    public function shouldGetOneUserByCriteria(User $user): void
    {
        $this->getOneUserByCriteria()
            ->shouldReceive('execute')
            ->once()
            ->andReturn($user);
    }

    public function shouldGetOneUserByCriteriaThrowException(): void
    {
        $this->getOneUserByCriteria()
            ->shouldReceive('execute')
            ->once()
            ->andThrow(UserNotFound::class);
    }
}