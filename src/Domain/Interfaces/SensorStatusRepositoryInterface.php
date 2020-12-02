<?php

namespace App\Domain\Interfaces;

use App\Domain\Entity\SensorStatus;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Interface SensorStatusRepositoryInterface
 * @package App\Domain\Interfaces
 */
interface SensorStatusRepositoryInterface
{
    /**
     * @param string $name
     *
     * @return SensorStatus|null
     *
     * @throws NonUniqueResultException
     */
    public function findByName(string $name): ?SensorStatus;
}