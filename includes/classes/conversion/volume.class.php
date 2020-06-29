<?php

declare(strict_types=1);

namespace conversion;

/**
 * Volume
 * 
 * @category volume
 * @package conversion
 * @author Paul Schudar
 * @copyright Copyright (c) 2020, Paul Schudar
 * @license https://opensource.org/licenses/mit-license.php MIT License
 * @internal Common Unit: Liters
 */
class Volume {

    use \calc\Calculate;

    const CONVERSION_ARRAY = [
        'cubic_inches' => 0.0163871,
        'cubic_feet' => 28.3168,
        'cubic_centimeters' => 0.001,
        'cubic_meters' => 1000,
        'imperial_gallons' => 4.54609,
        'imperial_quarts' => 1.1365225,
        'imperial_pints' => 0.56826125,
        'imperial_cups' => 0.284130625,
        'imperial_ounces' => 0.0284130625,
        'imperial_tablespoons' => 0.0177581641,
        'imperial_teaspoons' => 0.005919388020779234,
        'metric_cups' => 0.25,
        'metric_tablespoons' => 0.015,
        'metric_teaspoons' => 0.005,
        'us_gallons' => 3.785411784,
        'us_quarts' => 0.946352946,
        'us_pints' => 0.473176473,
        'us_cups' => 0.2365882365,
        'us_ounces' => 0.0295735296,
        'us_tablespoons' => 0.0147867648,
        'us_teaspoons' => 0.004928921593710937,
        'liters' => 1,
        'milliliters' => 0.001
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
