<?php

namespace App\Tests\Integration\Shared\Infrastructure\PhpUnit;

use App\Tests\Fixtures\Shared\Domain\FixtureLoader;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IntegrationTestCase extends KernelTestCase
{
    private FixtureLoader $fixtureLoader;

    protected function setUp(): void
    {
        self::bootKernel(['environment' => 'test']);
        $this->fixtureLoader = $this->service(FixtureLoader::class);
        parent::setUp();
    }

    protected function service($className)
    {
        return self::getContainer()->get($className);
    }

    protected function loadFixtures(): void
    {
        $this->fixtureLoader->loadFixtures();
    }

    protected function purge(): void
    {
        $this->fixtureLoader->purge();
    }
}