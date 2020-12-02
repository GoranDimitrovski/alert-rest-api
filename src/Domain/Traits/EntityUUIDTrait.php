<?php

namespace App\Domain\Traits;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

trait EntityUUIDTrait
{
    /**
     * @var UuidInterface
     *
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $uuid;

    /**
     * @param UuidInterface $uuid
     * @return self
     */
    public function setUuid(UuidInterface $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }
}