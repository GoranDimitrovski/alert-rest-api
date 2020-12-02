<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Alert;
use App\Domain\Interfaces\AlertRepositoryInterface;
use Doctrine\ORM\Internal\Hydration\IterableResult;
use Ramsey\Uuid\UuidInterface;

/**
 * Class AlertRepository
 * @package App\Infrastructure\Repository
 */
class AlertRepository extends AbstractRepository implements AlertRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findAllByUUID(UuidInterface $sensorId): IterableResult
    {
        return $this->entityManager->createQueryBuilder()
            ->from(Alert::class, 'a')
            ->innerJoin('a.sensor', 's')
            ->where('s.uuid = :uuid')
            ->setParameter('uuid', $sensorId)
            ->select('a')
            ->getQuery()
            ->iterate();
    }

    /**
     * @inheritDoc
     */
    public function save(Alert $alert): void
    {
        $this->entityManager->persist($alert);
        $this->entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function update(Alert $alert): void
    {
        $this->entityManager->flush();
    }
}