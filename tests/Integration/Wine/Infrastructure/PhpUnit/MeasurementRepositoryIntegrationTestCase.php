<?php

namespace App\Tests\Integration\Wine\Infrastructure\PhpUnit;

use App\Tests\Integration\Shared\Infrastructure\PhpUnit\IntegrationTestCase;
use App\Wine\Domain\Repository\MeasurementRepository;

class MeasurementRepositoryIntegrationTestCase extends IntegrationTestCase
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

    protected function repository(): MeasurementRepository
    {
        return $this->service(MeasurementRepository::class);
    }
}