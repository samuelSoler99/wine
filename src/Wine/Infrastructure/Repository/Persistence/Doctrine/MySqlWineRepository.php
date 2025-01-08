<?php

namespace App\Wine\Infrastructure\Repository\Persistence\Doctrine;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Infrastructure\Repository\Persistence\Doctrine\DoctrineRepository;
use App\Wine\Domain\Entity\Wine;
use App\Wine\Domain\Repository\WineRepository;
use Doctrine\ORM\EntityManager;

class MySqlWineRepository extends DoctrineRepository implements WineRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function findOneBy(Criteria $criteria)
    {
        return $this->repository(Wine::class)->findOneBy($criteria->plainFilters());
    }

    public function save(Wine $wine): void
    {
        $this->persist($wine);
    }

    public function deleteAll(): void
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->delete(Wine::class, 'wine');

        $query = $queryBuilder->getQuery();
        $query->execute();
    }

    /**
     * @return Wine[]
     */
    public function findAll(): array
    {
        return $this->repository(Wine::class)->findAll();
    }
}