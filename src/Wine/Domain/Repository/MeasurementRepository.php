<?php

namespace App\Wine\Domain\Repository;

use App\Shared\Domain\Criteria\Criteria;
use App\Wine\Domain\Entity\Measurement;

interface MeasurementRepository
{

    public function findOneBy(Criteria $criteria): ?Measurement;

    public function findBy(Criteria $criteria): array;

    public function save(Measurement $measurement): void;

    public function deleteAll(): void;
}