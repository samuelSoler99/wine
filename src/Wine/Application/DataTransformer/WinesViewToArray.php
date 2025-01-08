<?php

namespace App\Wine\Application\DataTransformer;

use App\Wine\Domain\ViewModel\MeasurementView;
use App\Wine\Domain\ViewModel\WineView;

class WinesViewToArray
{

    /**
     * @param WineView[] $winesViewById
     */
    public function transform(array $winesViewById): array
    {
        $array = [];
        foreach ($winesViewById as $wineView) {
            $wineArray = [
                'id' => $wineView->id(),
                'name' => $wineView->name(),
                'year' => $wineView->year(),
                'measurements' => []
            ];

            foreach ($wineView->measurementView() as $measurementView) {
                $wineArray['measurements'][] = $this->measurementViewToArray($measurementView);
            }

            $array[] = $wineArray;
        }

        return $array;
    }

    private function measurementViewToArray(MeasurementView $measurementView): array
    {
        return [
            'id' => $measurementView->id(),
            'idSensor' => $measurementView->idSensor(),
            'color' => $measurementView->color(),
            'year' => $measurementView->year(),
            'temperature' => $measurementView->temperature(),
            'graduation' => $measurementView->graduation(),
            'ph' => $measurementView->pH(),
        ];
    }
}