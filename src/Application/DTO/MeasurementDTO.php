<?php

namespace App\Application\DTO;

use DateTime;

/**
 * Class MeasurementDTO
 * @package App\Application\DTO
 */
final class MeasurementDTO extends BaseDTO
{
    /** @var int */
    private $co2;

    /** @var DateTime */
    private $time;

    /**
     * MeasurementDTO constructor.
     * @param int $co2
     * @param DateTime $time
     */
    public function __construct(int $co2, DateTime $time)
    {
        $this->co2 = $co2;
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getCo2(): int
    {
        return $this->co2;
    }

    /**
     * @return DateTime
     */
    public function getTime(): DateTime
    {
        return $this->time;
    }
}