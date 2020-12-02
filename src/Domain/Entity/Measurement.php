<?php

namespace App\Domain\Entity;

use App\Domain\Traits\CreatedEntityTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Measurement
 * @ORM\Entity
 * @ORM\Table(name="measurements")
 * @package App\Domain\Entity
 */
class Measurement extends BaseEntity
{
    use CreatedEntityTrait;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Entity\Sensor", inversedBy="mesurments")
     */
    private $sensor;

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level): self
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSensor(): ?Sensor
    {
        return $this->sensor;
    }

    /**
     * @param Sensor $sensor
     *
     * @return self
     */
    public function setSensor(Sensor $sensor): self
    {
        $this->sensor = $sensor;

        return $this;
    }
}
