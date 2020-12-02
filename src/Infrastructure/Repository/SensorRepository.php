<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Sensor;
use App\Domain\Interfaces\SensorRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

/**
 * Class SensorRepository
 * @package App\Infrastructure\Repository
 */
final class SensorRepository extends AbstractRepository implements SensorRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findByUUID(UuidInterface $sensorId): ?Sensor
    {
        return $this->entityManager->createQueryBuilder()
            ->from(Sensor::class, 's')
            ->where('s.uuid = :uuid')
            ->setParameter('uuid', $sensorId)
            ->select('s')
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @inheritDoc
     */
    public function save(Sensor $sensor): void
    {
        $this->entityManager->persist($sensor);
        $this->entityManager->flush();
    }
}
