<?php

namespace App\Domain\Entity;

use App\Domain\Traits\CreatedEntityTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Alert
 * @ORM\Entity
 * @ORM\Table(name="alerts")
 * @package App\Domain\Entity
 */
class Alert extends BaseEntity
{
    use CreatedEntityTrait;

    /**
     * @ORM\OneToOne(targetEntity="Sensor", inversedBy="Alert", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="sensor_id", referencedColumnName="id", nullable=false)
     */
    protected $sensor;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $measurement1;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $measurement2;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $measurement3;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @var DateTime
     */
    protected $startTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var DateTime
     */
    protected $endTime;

    /**
     * @return int
     */
    public function getMeasurement1(): int
    {
        return $this->measurement1;
    }

    /**
     * @param int $measurement1
     */
    public function setMeasurement1(int $measurement1): void
    {
        $this->measurement1 = $measurement1;
    }

    /**
     * @return int
     */
    public function getMeasurement2(): int
    {
        return $this->measurement2;
    }

    /**
     * @param int $measurement2
     */
    public function setMeasurement2(int $measurement2): void
    {
        $this->measurement2 = $measurement2;
    }

    /**
     * @return int
     */
    public function getMeasurement3(): int
    {
        return $this->measurement3;
    }

    /**
     * @param int $measurement3
     */
    public function setMeasurement3(int $measurement3): void
    {
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
     * @param DateTime $startTime
     */
    public function setStartTime(DateTime $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return DateTime|null
     */
    public function getEndTime(): ?DateTime
    {
        return $this->endTime;
    }

    /**
     * @param DateTime $endTime
     */
    public function setEndTime(DateTime $endTime): void
    {
        $this->endTime = $endTime;
    }
}