<?php

namespace App\Domain\Enum;

/**
 * Class SensorStatusEnum
 * @package App\Enum
 */
class SensorStatusEnum extends AbstractEnum
{
    public const ALERT = "ALERT";
    public const WARNING = "WARN";
    public const OK = "OK";
}