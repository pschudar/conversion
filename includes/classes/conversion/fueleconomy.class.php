<?php

declare(strict_types=1);

namespace conversion;

/**
 * FuelEconomy
 * 
 * @category fuel economy
 * @package conversion
 * @author Paul Schudar
 * @copyright Copyright (c) 2020, Paul Schudar
 * @license https://opensource.org/licenses/mit-license.php MIT License
 * @internal Common Unit: Kilometers per liter
 */
class FuelEconomy {

    use \calc\Calculate;

    const CONVERSION_ARRAY = [
        'kilometers_per_liter' => 1,
        'imperial_miles_per_gallon' => 0.354006,
        'us_miles_per_gallon' => 0.425144
    ];

    /**
     * Processes the conversion
     * 
     * @param string $value
     * @param string $from_unit
     * @param string $to_unit
     * @return float
     */
    public function processConversion(float $value, string $from_unit, string $to_unit) {
        return self::processConversions($value, $from_unit, $to_unit);
    }

}
