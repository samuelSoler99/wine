<?php

namespace App\Tests\Fixtures\Shared\Infrastructure;

use App\Tests\Fixtures\Shared\Domain\FixtureLoader;
use App\Tests\Fixtures\Wine\Infrastructure\UserFixture;

class MySqlFixtureLoader implements FixtureLoader
{
    public function __construct(
        private UserFixture $userFixture,
    ) {
    }

    public function loadFixtures(): void
    {
        $this->userFixture->load();
    }

    public function purge(): void
    {
        $this->userFixture->purge();
    }
}