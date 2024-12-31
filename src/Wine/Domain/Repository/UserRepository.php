<?php

namespace App\Wine\Domain\Repository;

use App\Shared\Domain\Criteria\Criteria;
use App\Wine\Domain\Entity\User;

/**
 * como es una prueba tecnica me voy a limitar a generar los metodos que acabe usando
 */
interface UserRepository
{
    public function findOneBy(Criteria $criteria);

    public function save(User $user): void;

    public function deleteAll(): void;
}