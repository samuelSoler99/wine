<?php

namespace App\Tests\Integration\Wine\Infrastructure\PhpUnit;

use App\Tests\Integration\Shared\Infrastructure\PhpUnit\IntegrationTestCase;
use App\Wine\Domain\Repository\WineRepository;

class WineRepositoryIntegrationTestCase extends IntegrationTestCase
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

    protected function repository(): WineRepository
    {
        return $this->service(WineRepository::class);
    }
}