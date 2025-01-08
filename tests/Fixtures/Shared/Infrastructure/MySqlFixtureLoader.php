<?php

namespace App\Tests\Fixtures\Shared\Infrastructure;

use App\Tests\Fixtures\Shared\Domain\FixtureLoader;
use App\Tests\Fixtures\Wine\Infrastructure\MeasurementFixture;
use App\Tests\Fixtures\Wine\Infrastructure\SensorFixture;
use App\Tests\Fixtures\Wine\Infrastructure\UserFixture;
use App\Tests\Fixtures\Wine\Infrastructure\WineFixture;

class MySqlFixtureLoader implements FixtureLoader
{
    public function __construct(
        private UserFixture $userFixture,
        private SensorFixture $sensorFixture,
        private WineFixture $wineFixture,
        private MeasurementFixture $measurementFixture,
    ) {
    }

    public function loadFixtures(): void
    {
        $this->userFixture->load();
        $this->sensorFixture->load();
        $this->wineFixture->load();
        $this->measurementFixture->load();
    }

    public function purge(): void
    {
        $this->userFixture->purge();
        $this->sensorFixture->purge();
        $this->wineFixture->purge();
        $this->measurementFixture->purge();
    }
}