<?php

namespace App\Application\DTO;

use App\Domain\Entity\BaseEntity;
use Doctrine\ORM\Query\Expr\Base;

/**
 * Class StatusDTO
 * @package App\Application\DTO
 */
final class StatusDTO extends BaseDTO
{
    /** @var string */
    private $status;

    /**
     * StatusDTO constructor.
     * @param string $status
     */
    public function __construct(string $status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}