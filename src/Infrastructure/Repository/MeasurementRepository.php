<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Measurement;
use App\Domain\Entity\Sensor;
use App\Domain\Interfaces\MeasurementRepositoryInterface;
use DateTime;
use Doctrine\ORM\QueryBuilder;
use Ramsey\Uuid\UuidInterface;

/**
 * Class MeasurementRepository
 * @package App\Infrastructure\Repository
 */
class MeasurementRepository extends AbstractRepository implements MeasurementRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function save(Measurement $measurement): Measurement
    {
        $this->entityManager->persist($measurement);
        $this->entityManager->flush();

        return $measurement;
    }

    /**
     * @inheritDoc
     */
    public function getMaxLastMonth(UuidInterface $uuid): int
    {
        $qb = $this->entityManager->createQueryBuilder();

        return $this->buildDQL($qb, $uuid)
            ->select($qb->expr()->max('m.level as maxLevel'))
            ->getQuery()
            ->getResult();
    }

    /**
     * @inheritDoc
     */
    public function getAvgLastMonth(UuidInterface $uuid): float
    {
        $qb = $this->entityManager->createQueryBuilder();

        return $this->buildDQL($qb, $uuid)
            ->select($qb->expr()->avg('m.level as avgLevel'))
            ->getQuery()
            ->getResult();
    }

    /**
     * @param QueryBuilder $queryBuilder
     *
     * @param UuidInterface $uuid
     *
     * @return QueryBuilder
     */
    private function buildDQL(QueryBuilder $queryBuilder, UuidInterface $uuid): QueryBuilder
    {
        return $queryBuilder->from(Sensor::class, 's')
            ->innerJoin('m.sensor', 's')
            ->where('s.uuid = :uuid')
            ->andWhere('e.date BETWEEN :from AND :to')
            ->setParameter('from', new DateTime('30 days ago'))
            ->setParameter('to', new DateTime())
            ->setParameter('uuid', $uuid);
    }
}
