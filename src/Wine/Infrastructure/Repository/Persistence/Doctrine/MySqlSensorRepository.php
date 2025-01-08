<?php

namespace App\Wine\Infrastructure\Repository\Persistence\Doctrine;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Repository\Persistence\Doctrine\DoctrineRepository;
use App\Wine\Domain\Entity\Sensor;
use App\Wine\Domain\Repository\SensorRepository;
use Doctrine\ORM\EntityManager;

class MySqlSensorRepository extends DoctrineRepository implements SensorRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function findOneBy(Criteria $criteria)
    {
        return $this->repository(Sensor::class)->findOneBy($criteria->plainFilters());
    }

    public function save(Sensor $sensor): void
    {
        $this->persist($sensor);
    }

    public function deleteAll(): void
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->delete(Sensor::class,'sensor');
        $queryBuilder->getQuery()->execute();
    }

    public function findAllOrderedByName(): array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        return $queryBuilder
            ->select('sensor')
            ->from(Sensor::class, 'sensor')
            ->orderBy('sensor.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function find(Uuid $id): ?Sensor
    {
       return $this->repository(Sensor::class)->find($id->value);
    }

    public function delete(Sensor $sensor): void
    {
        $this->remove($sensor);
    }
}