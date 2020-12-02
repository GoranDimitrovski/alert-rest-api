<?php

namespace App\Application\DTO;

use DateTime;

/**
 * Class AlertDTO
 * @package App\Application\DTO
 */
final class AlertDTO extends BaseDTO
{
    /** @var DateTime */
    private $startTime;

    /** @var DateTime|null */
    private $endTime;

    /** @var int */
    private $measurement1;

    /** @var int */
    private $measurement2;

    /** @var int */
    private $measurement3;

    /**
     * AlertDTO constructor.
     * @param DateTime $startTime
     * @param DateTime|null $endTime
     * @param int $measurement1
     * @param int $measurement2
     * @param int $measurement3
     */
    public function __construct(
        DateTime $startTime,
        ?DateTime $endTime,
        int $measurement1,
        int $measurement2,
        int $measurement3
    ) {
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->measurement1 = $measurement1;
        $this->measurement2 = $measurement2;
        $this->measurement3 = $measurement3;
    }

    /**
     * @return DateTime
     */
    public function getStartTime(): DateTime
    {
        return $this->startTime;
    }

    /**
     * @return DateTime
     */
    public function getEndTime(): ?DateTime
    {
        return $this->endTime;
    }

    /**
     * @return int
     */
    public function getMeasurement1(): int
    {
        return $this->measurement1;
    }

    /**
     * @return int
     */
    public function getMeasurement2(): int
    {
        return $this->measurement2;
    }

    /**
     * @return int
     */
    public function getMeasurement3(): int
    {
        return $this->measurement3;
    }
}