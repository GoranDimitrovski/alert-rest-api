<?php

namespace App\Application\DTO;

/**
 * Class MetricDTO
 * @package App\Application\DTO
 */
final class MetricDTO extends BaseDTO
{
    /** @var int */
    private $maxLast30Days;

    /** @var float */
    private $avgLast30Days;

    /**
     * MetricDTO constructor.
     * @param int $maxLast30Days
     * @param float $avgLast30Days
     */
    public function __construct(int $maxLast30Days, float $avgLast30Days)
    {
        $this->maxLast30Days = $maxLast30Days;
        $this->avgLast30Days = $avgLast30Days;
    }

    /**
     * @return int
     */
    public function getMaxLast30Days(): int
    {
        return $this->maxLast30Days;
    }

    /**
     * @return float
     */
    public function getAvgLast30Days(): float
    {
        return $this->avgLast30Days;
    }
}
