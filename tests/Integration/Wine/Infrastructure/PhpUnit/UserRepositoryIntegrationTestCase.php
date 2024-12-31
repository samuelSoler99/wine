<?php

namespace App\Tests\Integration\Wine\Infrastructure\PhpUnit;

use App\Tests\Fixtures\Shared\Domain\FixtureLoader;
use App\Tests\Integration\Shared\Infrastructure\PhpUnit\IntegrationTestCase;
use App\Wine\Domain\Repository\UserRepository;

class UserRepositoryIntegrationTestCase extends IntegrationTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->purge();
        $this->loadFixtures();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->purge();
    }

    protected function repository(): UserRepository
    {
        return $this->service(UserRepository::class);
    }
}