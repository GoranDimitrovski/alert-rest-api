<?php

namespace App\Application\DTO;

use ReflectionClass;

/**
 * Class BaseDTO
 * @package App\Application\DTO
 */
abstract class BaseDTO
{
    public function toArray(): array
    {
        $reflectionClass = new ReflectionClass(get_class($this));
        $array = [];
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($this);
            $property->setAccessible(false);
        }
        return $array;
    }

}