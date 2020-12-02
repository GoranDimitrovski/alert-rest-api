<?php

namespace App\Domain\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait CreatedEntityTrait
{
    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $createdAt;

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}