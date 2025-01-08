<?php

namespace App\Wine\Domain\Repository;

use App\Shared\Domain\Criteria\Criteria;
use App\Wine\Domain\Entity\Wine;

interface WineRepository
{
    public function findAll(): array;
    public function findOneBy(Criteria $criteria);

    public function save(Wine $wine): void;

    public function deleteAll(): void;
}