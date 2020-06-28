<?php

declare(strict_types=1); # commenting this out for now

namespace conversion;

class Volume {

    use \calc\Calculate;

    const CONVERSION_ARRAY = [
        'cubic_inches' => 0.0163871,
        'cubic_feet' => 28.3168,
        'cubic_centimeters' => 0.001,
        'cubic_meters' => 1000,
        'imperial_gallons' => 4.54609,
        'imperial_quarts' => 1.1365225,
        'imperial_pints' => 0.56826125,
        'imperial_cups' => 0.284130625,
        'imperial_ounces' => 0.0284130625,
        'imperial_tablespoons' => 0.0177581641,
        'imperial_teaspoons' => 0.005919388020779234,
        'metric_cups' => 0.25,
        'metric_tablespoons' => 0.015,
        'metric_teaspoons' => 0.005,
        'us_gallons' => 3.785411784,
        'us_quarts' => 0.946352946,
        'us_pints' => 0.473176473,
        'us_cups' => 0.2365882365,
        'us_ounces' => 0.0295735296,
        'us_tablespoons' => 0.0147867648,
        'us_teaspoons' => 0.004928921593710937,
        'liters' => 1,
        'milliliters' => 0.001
    ];

    private $value;
    private $processedValue;

    /**
     * Processes the digital storage conversions
     * 
     * @param string $value
     * @param string $from_unit
     * @param string $to_unit
     * @return float
     */
    public function convertVolume(float $value, string $from_unit, string $to_unit) {
        $this->value = self::convertToLiters($value, $from_unit, $to_unit);
        $this->processedValue = self::convertFromLiters($this->value, $to_unit, $from_unit);
        return $this->processedValue;
    }

    /**
     * Converts other storage formats to bits
     * 
     * @param float $value
     * @param string $from_unit
     * @return float|string
     */
    private static function convertToLiters(float $value, string $from_unit) {
        switch (array_key_exists($from_unit, self::CONVERSION_ARRAY)) :
            case false:
                throw new \conversion\ConversionError(UNSUPPORTED . ': ' . $from_unit);
            default:
                return self::calculate($value, $from_unit, self::CONVERSION_ARRAY, 'multiply');
        endswitch;
    }

    /**
     * Converts bits to other formats
     * 
     * @param float $value
     * @param string $to_unit
     * @return float|string
     */
    private static function convertFromLiters(float $value, string $to_unit) {
        switch (array_key_exists($to_unit, self::CONVERSION_ARRAY)) :
            case false:
                throw new \conversion\ConversionError(UNSUPPORTED . ': ' . $to_unit);
            default:
                return self::calculate($value, $to_unit, self::CONVERSION_ARRAY, 'divide');
        endswitch;
    }

}
