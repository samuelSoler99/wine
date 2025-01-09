<?php

namespace App\Tests\Integration\Wine\Application\Command\Handler;

use App\Tests\Integration\Wine\Infrastructure\PhpUnit\WineIntegrationTestCase;
use App\Tests\Mother\Wine\Application\Command\ListWinesMother;
use App\Wine\Application\Command\Handler\ListWinesHandler;
use App\Wine\Domain\ViewModel\MeasurementView;
use App\Wine\Domain\ViewModel\WineView;

class ListWineHandlerIntegrationTest extends WineIntegrationTestCase
{
    private ListWinesHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = $this->service(ListWinesHandler::class);
    }

    public function testHandle(): void
    {
        $wineViewList = $this->handler->handle(ListWinesMother::random());
        $this->assertCount(2, $wineViewList);
        foreach ($wineViewList as $idWine => $wineView) {
            $this->assertInstanceOf(WineView::class, $wineView);
            foreach ($wineView->measurementView() as $measurementView) {
                $this->assertInstanceOf(MeasurementView::class, $measurementView);
                $this->assertEquals($idWine, $measurementView->idWine());
            }
        }
    }
}