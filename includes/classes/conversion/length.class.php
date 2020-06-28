<?php

declare(strict_types=1);

namespace conversion;

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

    private $value;
    private $processedValue;

    /**
     * Processes the length conversions
     * 
     * @param string $value
     * @param string $from_unit
     * @param string $to_unit
     * @return float
     */
    public function convertLength(float $value, string $from_unit, string $to_unit) {
        $this->value = self::convertToMeters($value, $from_unit, $to_unit);
        $this->processedValue = self::convertFromMeters($this->value, $to_unit, $from_unit);
        return $this->processedValue;
    }

    /**
     * Converts other length formats to meters
     * 
     * @param float $value
     * @param string $from_unit
     * @return float|string
     */
    private static function convertToMeters(float $value, string $from_unit) {
        switch (array_key_exists($from_unit, self::CONVERSION_ARRAY)) :
            case false:
                throw new \conversion\ConversionError(UNSUPPORTED . ': ' . $from_unit);
            default:
                return self::calculate($value, $from_unit, self::CONVERSION_ARRAY, 'multiply');
        endswitch;
    }

    /**
     * Converts meters to other formats
     * 
     * @param float $value
     * @param string $to_unit
     * @return float|string
     */
    private static function convertFromMeters(float $value, string $to_unit) {
        switch (array_key_exists($to_unit, self::CONVERSION_ARRAY)) :
            case false:
                throw new \conversion\ConversionError(UNSUPPORTED . ': ' . $to_unit);
            default:
                return self::calculate($value, $to_unit, self::CONVERSION_ARRAY, 'divide');
        endswitch;
    }

}
