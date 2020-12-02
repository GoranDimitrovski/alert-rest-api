<?php

namespace App\Domain\Interfaces;

use App\Domain\Entity\Alert;
use Doctrine\ORM\Internal\Hydration\IterableResult;
use Ramsey\Uuid\UuidInterface;

/**
 * Interface AlertRepositoryInterface
 * @package App\Infrastructure\Interfaces
 */
interface AlertRepositoryInterface
{
    /**
     * @param UuidInterface $sensorId
     *
     * @return IterableResult
     */
    public function findAllByUUID(UuidInterface $sensorId): IterableResult;

    /**
     * @param Alert $alert
     *
     * return void
     */
    public function save(Alert $alert): void;

    /**
     * @param Alert $alert
     *
     * return void
     */
    public function update(Alert $alert): void;
}