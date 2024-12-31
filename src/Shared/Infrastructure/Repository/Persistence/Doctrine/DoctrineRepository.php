<?php

namespace App\Shared\Infrastructure\Repository\Persistence\Doctrine;



use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineRepository
{
    protected EntityManager $entityManager;

    protected function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function entityManager(): EntityManager
    {
        return $this->entityManager;
    }

    //todo por agilizar, coloco mixed en lugar de usar un aggregate root
    protected function persist(mixed $entity): void
    {
        $this->entityManager()->persist($entity);
        $this->entityManager()->flush();
    }

    protected function repository($entityClass): EntityRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }

    protected function remove(mixed $entity): void
    {
        $this->entityManager()->remove($entity);
        $this->entityManager()->flush();
    }
}