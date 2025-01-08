<?php

namespace App\Wine\Application\DateMapper;

use App\Wine\Domain\Entity\Wine;
use App\Wine\Domain\ViewModel\MeasurementView;
use App\Wine\Domain\ViewModel\WineView;

//TODO creat test unitario
class WinesViewByIdMapper
{
    /**
     * @param Wine[] $wines
     * @param MeasurementView[] $measurementsViewByWineId
     */
    public static function map(array $wines, array $measurementsViewByWineId): array
    {
        $winesViewById = [];
        foreach ($wines as $wine) {
            $wineView = WineView::create(
                $wine,
                $measurementsViewByWineId[$wine->id()->value]
            );

            $winesViewById[$wineView->id()] = $wineView;
        }

        return $winesViewById;
    }
}