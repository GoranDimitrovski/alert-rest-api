<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\SensorStatus;
use App\Domain\Interfaces\SensorStatusRepositoryInterface;

/**
 * Class SensorStatusRepository
 * @package App\Infrastructure\Repository
 */
class SensorStatusRepository extends AbstractRepository implements SensorStatusRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findByName(string $name): ?SensorStatus
    {
        $qb = $this->entityManager->createQueryBuilder();

        return $qb->from(SensorStatus::class, 's')
            ->where('s.name = :name')
            ->setParameter('name', $name)
            ->select('s')
            ->getQuery()
            ->getOneOrNullResult();
    }
}