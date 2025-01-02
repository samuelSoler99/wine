<?php

namespace App\Tests\Integration\Wine\Infrastructure\PhpUnit;

use App\Tests\Integration\Shared\Infrastructure\PhpUnit\IntegrationTestCase;
use App\Wine\Domain\Repository\UserRepository;

class WineIntegrationTestCase extends IntegrationTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->loadFixtures();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->purge();
    }

    protected function userRepository(): UserRepository
    {
        return $this->service(UserRepository::class);
    }
}