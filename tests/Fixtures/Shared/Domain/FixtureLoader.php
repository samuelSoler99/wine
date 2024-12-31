<?php

namespace App\Tests\Fixtures\Shared\Domain;

interface FixtureLoader
{
    public function loadFixtures(): void;
    public function purge(): void;
}