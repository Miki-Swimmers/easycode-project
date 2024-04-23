<?php

namespace App\Traits;

trait EnumToArray
{
    /**
     * Преобразовать в массив
     */
    public static function toArray(): array
    {
        $arr = [];

        /** @var \UnitEnum $enum */
        foreach (self::cases() as $enum) {
            property_exists($enum, 'value')
                ? $arr[$enum->name] = $enum->value
                : $arr[] = $enum->name;
        }

        return $arr;
    }
}
