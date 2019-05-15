<?php


namespace App\Mappers;

use App\PetrolPrice;


class PetrolPriceMapper
{
    /**
     * Returns new PetrolPrice model instance
     *
     * @param array $fuelTypes
     * @return PetrolPrice
     */
    public static function create(array $fuelTypes): PetrolPrice {
        return new PetrolPrice(static::mapPetrolPrices($fuelTypes));
    }

    /**
     * Maps fuel types
     *
     * @param array $fuleTypes
     * @return array
     */
    private static function mapPetrolPrices(array $fuleTypes) {
        $result = [];

        foreach ($fuleTypes as $type) {
            switch ($type->name) {
                case 'Pb95 (E5)':
                    $result['pb95'] = $type->price;
                    break;
                case 'Pb98 (E5)':
                    $result['pb98'] = $type->price;
                    break;
                case 'ON (B7)':
                    $result['diesel'] = $type->price;
                    break;
                case 'LPG':
                    $result['lpg'] = $type->price;
                    break;
            }
        }

        return $result;
    }
}