<?php

namespace App\Wine\Infrastructure\Repository\Persistence\Doctrine;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Infrastructure\Repository\Persistence\Doctrine\DoctrineRepository;
use App\Wine\Domain\Entity\Measurement;
use App\Wine\Domain\Repository\MeasurementRepository;
use Doctrine\ORM\EntityManager;

class MySqlMeasurementRepository extends DoctrineRepository implements MeasurementRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function findOneBy(Criteria $criteria): ?Measurement
    {
        return $this->repository(Measurement::class)->findOneBy($criteria->plainFilters());
    }

    public function findBy(Criteria $criteria): array
    {
        return $this->repository(Measurement::class)->findBy(
            $criteria->plainFilters(),
            $criteria->plainOrders(),
            $criteria->limit(),
            $criteria->offset()
        );
    }

    public function save(Measurement $measurement): void
    {
        $this->persist($measurement);
    }

    public function deleteAll(): void
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->delete(Measurement::class, 'measurement');
        $queryBuilder->getQuery()->execute();
    }
}