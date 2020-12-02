<?php

namespace App\Domain\Enum;

use ReflectionClass;
use UnexpectedValueException;

/**
 * Class AbstractEnum
 * @package App\Enum
 */
abstract class AbstractEnum
{
    /**
     * @param $typeShortName
     * @return string
     */
    public static function getByName($typeShortName): string
    {
        $availableConstList = self::getAvailableConstantList();

        if (isset($availableConstList[$typeShortName])) {
            return $availableConstList[$typeShortName];
        } else {
            throw new UnexpectedValueException('Unknown constant name');
        }
    }

    /**
     * @return array
     */
    public static function getAvailableTypes(): array
    {
        return self::getAvailableConstantList();
    }

    /**
     * @param $constantName
     * @return bool
     */
    public static function isValidName($constantName): bool
    {
        $availableConstList = self::getAvailableConstantList();
        return isset($availableConstList[$constantName]);
    }

    /**
     * @param $constantValue
     * @return bool
     */
    public static function isValidValue($constantValue):bool
    {
        $availableConstList = self::getAvailableConstantList();
        return array_search($constantValue, $availableConstList, true) !== false;
    }

    /**
     * returns a array with available constants
     * @return array|null
     */
    private static function getAvailableConstantList()
    {
        return (new ReflectionClass(static::class))->getConstants();
    }
}