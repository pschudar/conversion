<?php

declare(strict_types=1);

namespace conversion;

class FuelEconomy {

    use \calc\Calculate;

    const CONVERSION_ARRAY = [
        'kilometers_per_liter' => 1,
        'imperial_miles_per_gallon' => 0.354006,
        'us_miles_per_gallon' => 0.425144
    ];

    private $value;
    private $processedValue;

    /**
     * Processes the fuel economy conversions
     * 
     * @internal Common Unit: Kilometers per liter
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
