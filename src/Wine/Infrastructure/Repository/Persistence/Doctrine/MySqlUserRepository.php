<?php

namespace App\Wine\Infrastructure\Repository\Persistence\Doctrine;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Infrastructure\Repository\Persistence\Doctrine\DoctrineRepository;
use App\Wine\Domain\Entity\User;
use App\Wine\Domain\Repository\UserRepository;
use Doctrine\ORM\EntityManager;

class MySqlUserRepository extends DoctrineRepository implements UserRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
    }


    public function findOneBy(Criteria $criteria): ?User
    {
        return $this->repository(User::class)->findOneBy($criteria->plainFilters());
    }

    public function save(User $user): void
    {
        $this->persist($user);
    }

    public function deleteAll(): void
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->delete(User::class,'user');

        $query = $queryBuilder->getQuery();
        $query->execute();
    }
}