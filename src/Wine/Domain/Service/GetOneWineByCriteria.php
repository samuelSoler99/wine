<?php

namespace App\Wine\Domain\Service;

use App\Shared\Domain\Criteria\Criteria;
use App\Wine\Domain\Entity\Wine;
use App\Wine\Domain\Exception\WineNotFound;
use App\Wine\Domain\Repository\WineRepository;

class GetOneWineByCriteria
{
    public function __construct(
        private WineRepository $sensorRepository
    ) {
    }

    /**
     * @throws WineNotFound
     */
    public function execute(Criteria $criteria): Wine
    {
        return $this->sensorRepository->findOneBy($criteria) ?? throw new WineNotFound('Wine not found', 404);
    }
}