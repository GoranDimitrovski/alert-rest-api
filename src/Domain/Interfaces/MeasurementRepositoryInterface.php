<?php

namespace App\Domain\Interfaces;


use App\Domain\Entity\Measurement;
use Ramsey\Uuid\UuidInterface;

interface MeasurementRepositoryInterface
{
    /**
     * @param Measurement $measurement
     *
     * @return Measurement
     */
    public function save(Measurement $measurement): Measurement;

    /**
     * @param UuidInterface $uuid
     *
     * @return int
     */
    public function getMaxLastMonth(UuidInterface $uuid): int;

    /**
     * @param UuidInterface $uuid
     *
     * @return float
     */
    public function getAvgLastMonth(UuidInterface $uuid): float;
}