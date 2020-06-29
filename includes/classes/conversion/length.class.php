<?php

declare(strict_types=1);

namespace conversion;

/**
 * Length
 * 
 * @category length
 * @package conversion
 * @author Paul Schudar
 * @copyright Copyright (c) 2020, Paul Schudar
 * @license https://opensource.org/licenses/mit-license.php MIT License
 * @internal Common Unit: Meters
 */
class Length {

    use \calc\Calculate;

    const CONVERSION_ARRAY = [
        'inches' => 0.0254,
        'feet' => 0.3048,
        'yards' => 0.9144,
        'miles' => 1609.344,
        'millimeters' => 0.001,
        'centimeters' => 0.01,
        'meters' => 1,
        'kilometers' => 1000,
        'acres' => 63.614907234075,
        'hectares' => 100,
        'nautical_miles' => 1852,
        'fathoms' => 1.8288
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
