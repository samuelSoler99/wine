<?php

namespace App\Tests\Integration\Wine\Infrastructure\PhpUnit;

use App\Tests\Integration\Shared\Infrastructure\PhpUnit\IntegrationTestCase;
use App\Wine\Domain\Repository\MeasurementRepository;
use App\Wine\Domain\Repository\SensorRepository;
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

    protected function sensorRepository(): SensorRepository
    {
        return $this->service(SensorRepository::class);
    }

    protected function measurementRepository(): MeasurementRepository
    {
        return $this->service(MeasurementRepository::class);
    }
}