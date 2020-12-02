<?php

namespace App\Domain\Entity;

use App\Domain\Traits\CreatedEntityTrait;
use App\Domain\Traits\EntityUUIDTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Sensor
 * @ORM\Entity
 * @ORM\Table(name="sensors")
 * @package App\Domain\Entity
 */
class Sensor extends BaseEntity
{
    use EntityUUIDTrait;
    use CreatedEntityTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Entity\SensorStatus", inversedBy="status")
     */
    protected $status;

    /**
     * @return SensorStatus
     */
    public function getStatus(): SensorStatus
    {
        return $this->status;
    }

    /**
     * @param SensorStatus $status
     * @return self
     */
    public function setStatus(SensorStatus $status): self
    {
        $this->status = $status;
        return $this;
    }
}
