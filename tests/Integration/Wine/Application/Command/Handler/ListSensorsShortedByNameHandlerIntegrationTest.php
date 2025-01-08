<?php

namespace App\Tests\Integration\Wine\Application\Command\Handler;

use App\Tests\Fixtures\Wine\Infrastructure\SensorFixture;
use App\Tests\Integration\Wine\Infrastructure\PhpUnit\WineIntegrationTestCase;
use App\Tests\Mother\Wine\Application\Command\ListSensorsShortedByNameMother;
use App\Wine\Application\Command\Handler\ListSensorsShortedByNameHandler;

class ListSensorsShortedByNameHandlerIntegrationTest extends WineIntegrationTestCase
{
    private ListSensorsShortedByNameHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = $this->service(ListSensorsShortedByNameHandler::class);
    }

    public function testHandle(): void
    {
        $sensors = $this->handler->handle(ListSensorsShortedByNameMother::random());
        $this->assertEquals(SensorFixture::SENSOR_2_NAME, $sensors[0]->name());
        $this->assertEquals(SensorFixture::SENSOR_3_NAME, $sensors[1]->name());
        $this->assertEquals(SensorFixture::SENSOR_1_NAME, $sensors[2]->name());
    }
}