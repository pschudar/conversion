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
     * @param string $value
     * @param string $from_unit
     * @param string $to_unit
     * @return float
     */
    public function convertSpeed(float $value, string $from_unit, string $to_unit) {
        $this->value = self::convertToMetersPerSecond($value, $from_unit, $to_unit);
        $this->processedValue = self::convertFromMetersPerSecond($this->value, $to_unit, $from_unit);
        return $this->processedValue;
    }

    /**
     * Converts other speed formats to meters per second
     * 
     * @param float $value
     * @param string $from_unit
     * @return float|string
     */
    private static function convertToMetersPerSecond(float $value, string $from_unit) {
        switch (array_key_exists($from_unit, self::CONVERSION_ARRAY)) :
            case false:
                throw new \conversion\ConversionError(UNSUPPORTED . ': ' . $from_unit);
            default:
                return self::calculate($value, $from_unit, self::CONVERSION_ARRAY, 'multiply');
        endswitch;
    }

    /**
     * Converts meters per second to other formats
     * 
     * @param float $value
     * @param string $to_unit
     * @return float|string
     */
    private static function convertFromMetersPerSecond(float $value, string $to_unit) {
        switch (array_key_exists($to_unit, self::CONVERSION_ARRAY)) :
            case false:
                throw new \conversion\ConversionError(UNSUPPORTED . ': ' . $to_unit);
            default:
                return self::calculate($value, $to_unit, self::CONVERSION_ARRAY, 'divide');
        endswitch;
    }

}
