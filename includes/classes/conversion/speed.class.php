<?php

declare(strict_types=1);

namespace conversion;

class Speed {

    use \calc\Calculate;

    const CONVERSION_ARRAY = [
        'feet_per_second' => 0.3048,
        'miles_per_hour' => 0.44704,
        'meters_per_second' => 1,
        'kilometers_per_hour' => 0.2777777778,
        'nautical_miles_per_hour' => 0.5144444424
    ];

    private $value;
    private $processedValue;

    /**
     * Processes the speed conversions
     * 
     * @internal Common Unit: Meters per second
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
