<?php

declare(strict_types=1);

namespace conversion;

class Mass {

    use \calc\Calculate;

    const CONVERSION_ARRAY = [
        'ounces' => 0.0283495,
        'pounds' => 0.453592,
        'stones' => 6.3502931799,
        'long_tons' => 1016.05,
        'short_tons' => 907.185,
        'milligrams' => 0.000001,
        'grams' => 0.001,
        'kilograms' => 1,
        'metric_tons' => 1000
    ];

    private $value;
    private $processedValue;

    /**
     * Processes the mass and weight conversions
     * 
     * @internal Common Unit: Kilograms
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
