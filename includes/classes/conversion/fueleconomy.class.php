<?php

declare(strict_types=1);

namespace conversion;

class FuelEconomy {
    
    use \calc\Calculate;

    const CONVERSION_ARRAY = [
        'kilometers_per_liter' => 1,
        'us_miles_per_gallon' => 2.35215,
        'imperial_miles_per_gallon' => 2.82481
    ];

    private $value;
    private $processedValue;

    /**
     * Processes the fuel economy conversions
     * 
     * @param string $value
     * @param string $from_unit
     * @param string $to_unit
     * @return float
     */
    public function convertFuelEconomy(float $value, string $from_unit, string $to_unit) {
        $this->value = self::convertToKilometersPerLiter($value, $from_unit, $to_unit);
        $this->processedValue = self::convertFromKilometersPerLiter($this->value, $to_unit, $from_unit);
        return $this->processedValue;
    }

    /**
     * Converts other fuel economy formats to kilometers per liter
     * 
     * @param float $value
     * @param string $from_unit
     * @return float|string
     */
    private static function convertToKilometersPerLiter(float $value, string $from_unit) {
        switch (array_key_exists($from_unit, self::CONVERSION_ARRAY)) :
            case false:
                throw new \conversion\ConversionError(UNSUPPORTED . ': ' . $from_unit);
            default:
                return self::calculate($value, $from_unit, self::CONVERSION_ARRAY, 'multiply');
        endswitch;
    }

    /**
     * Converts kilometers per liter to other formats
     * 
     * @param float $value
     * @param string $to_unit
     * @return float|string
     */
    private static function convertFromKilometersPerLiter(float $value, string $to_unit) {
        switch (array_key_exists($to_unit, self::CONVERSION_ARRAY)) :
            case false:
                throw new \conversion\ConversionError(UNSUPPORTED . ': ' . $to_unit);
            default:
                return self::calculate($value, $to_unit, self::CONVERSION_ARRAY, 'divide');
        endswitch;
    }

}
