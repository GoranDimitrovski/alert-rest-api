<?php

namespace App\Infrastructure\Repository;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractRepository
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * AbstractRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}