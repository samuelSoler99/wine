<?php

namespace App\Wine\Application\Command\Handler;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Wine\Application\Command\ListWines;
use App\Wine\Application\DateMapper\MeasurementsViewByWineIdMapper;
use App\Wine\Application\DateMapper\WinesViewByIdMapper;
use App\Wine\Domain\Repository\MeasurementRepository;
use App\Wine\Domain\Repository\WineRepository;
use App\Wine\Domain\ViewModel\WineView;

class ListWinesHandler
{
    public function __construct(
        private WineRepository $wineRepository,
        private MeasurementRepository $measurementRepository,
        private MeasurementsViewByWineIdMapper $measurementsViewByIdMapper,
        private WinesViewByIdMapper $winesViewByIdMapper,
    ) {
    }

    /**
     * @return WineView[]
     */
    public function handle(ListWines $command): array
    {
        $wines = $this->wineRepository->findAll();

        $measurements = $this->measurementRepository->findBy(
            Criteria::create(
                Filters::fromValues([
                    'idWine' => array_map(fn($wine) => $wine->id(), $wines)
                ])
            )
        );

        $measurements = $this->measurementsViewByIdMapper->map($measurements);

        return $this->winesViewByIdMapper->map($wines, $measurements);
    }
}