<?php

namespace App\Domain\Interfaces;

use App\Domain\Entity\Sensor;
use Doctrine\ORM\NonUniqueResultException;
use Ramsey\Uuid\UuidInterface;

/**
 * Interface SensorRepositoryInterface
 * @package App\Infrastructure\Interfaces
 */
interface SensorRepositoryInterface
{
    /**
     * @param UuidInterface $sensorId
     *
     * @throws NonUniqueResultException
     *
     * @return Sensor|null
     */
    public function findByUUID(UuidInterface $sensorId): ?Sensor;

    /**
     * @param Sensor $sensor
     */
    public function save(Sensor $sensor): void;
}
