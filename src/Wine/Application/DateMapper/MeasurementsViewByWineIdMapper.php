<?php

namespace App\Wine\Application\DateMapper;

use App\Wine\Domain\Entity\Measurement;
use App\Wine\Domain\ViewModel\MeasurementView;
//TODO creat test unitario
class MeasurementsViewByWineIdMapper
{

    /**
     * @param Measurement[] $measurements
     * @return MeasurementView[]
     */
    public static function map(array $measurements): array
    {
        $measurementsViewById = [];
        foreach ($measurements as $measurement) {
            $measurementView = MeasurementView::create(
                $measurement,
            );

            $measurementsViewById[$measurementView->idWine()][] = $measurementView;
        }

        return $measurementsViewById;
    }
}