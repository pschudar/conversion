<?php

declare(strict_types=1);

namespace conversion;

/**
 * Speed
 * 
 * @category speed
 * @package conversion
 * @author Paul Schudar
 * @copyright Copyright (c) 2020, Paul Schudar
 * @license https://opensource.org/licenses/mit-license.php MIT License
 * @internal Common Unit: Meters per second
 */
class Speed {

    use \calc\Calculate;

    const CONVERSION_ARRAY = [
        'feet_per_second' => 0.3048,
        'miles_per_hour' => 0.44704,
        'meters_per_second' => 1,
        'kilometers_per_hour' => 0.2777777778,
        'nautical_miles_per_hour' => 0.5144444424
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
