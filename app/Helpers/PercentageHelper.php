<?php

namespace App\Helpers;

class PercentageHelper
{
    /**
     * Agrega el porcentaje a una colección basándose en un total.
     *
     * @param \Illuminate\Support\Collection $collection
     * @param int|float $total
     * @param string $fieldName El nombre del campo donde se guardará el porcentaje
     * @return \Illuminate\Support\Collection
     */
    public static function addPercentage($collection, $total, $fieldName = 'porcentaje')
    {
        return $collection->map(function ($item) use ($total, $fieldName) {
            $item->{$fieldName} = $total > 0 ? round(($item->total / $total) * 100, 1) : 0;
            return $item;
        });
    }
}
