<?php

declare(strict_types=1);

namespace conversion;

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

    private $value;
    private $processedValue;

    /**
     * Processes the time conversions
     * 
     * @internal Common Unit: seconds
     * 
     * @param string $value
     * @param string $from_unit
     * @param string $to_unit
     * @return float
     */
    public function processConversion(float $value, string $from_unit, string $to_unit) {
        $this->value = self::convertToUnit($value, $from_unit, $to_unit);
        $this->processedValue = self::convertFromUnit($this->value, $to_unit, $from_unit);
        return $this->processedValue;
    }

}
