<?php

namespace App\Wine\Domain\Repository;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\ValueObject\Uuid;
use App\Wine\Domain\Entity\Sensor;

interface SensorRepository
{
    public function find(Uuid $id): ?Sensor;

    public function findOneBy(Criteria $criteria);

    public function save(Sensor $sensor): void;

    public function delete(Sensor $sensor): void;

    public function deleteAll(): void;

    public function findAllOrderedByName(): array;
}