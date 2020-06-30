<?php

declare(strict_types=1);

namespace conversion;

/**
 * Time
 * 
 * @category time
 * @package conversion
 * @author Paul Schudar
 * @copyright Copyright (c) 2020, Paul Schudar
 * @license https://opensource.org/licenses/mit-license.php MIT License
 * @internal Common Unit: Seconds
 */
class Time {

    use \calc\Calculate;

    const CONVERSION_ARRAY = [
        'nanoseconds' => 0.000000001,
        'milliseconds' => 0.001,
        'seconds' => 1,
        'minutes' => 60,
        'hours' => 3600,
        'days' => 86400,
        'weeks' => 604800,
        'months' => 2628000,
        'years' => 31540000,
        'decades' => 315400000,
        'centuries' => 3154000000,
        'millenia' => 31540000000
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
