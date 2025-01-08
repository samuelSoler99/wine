<?php

namespace App\Tests\Integration\Wine\Infrastructure\PhpUnit;

use App\Tests\Integration\Shared\Infrastructure\PhpUnit\IntegrationTestCase;
use App\Wine\Domain\Repository\SensorRepository;

class SensorRepositoryIntegrationTestCase extends IntegrationTestCase
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

    protected function repository(): SensorRepository
    {
        return $this->service(SensorRepository::class);
    }
}