<?php

namespace App\Domain\Entity;

use App\Domain\Enum\SensorStatusEnum;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

/**
 * Class SensorStatus
 * @ORM\Entity
 * @ORM\Table(name="sensor_status")
 * @package App\Domain\Entity
 */
class SensorStatus extends BaseEntity
{
    /**
     * @var string
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        if (!SensorStatusEnum::isValidValue($name)) {
            throw new InvalidArgumentException(sprintf("Invalid alert type %s", $name));
        }

        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
