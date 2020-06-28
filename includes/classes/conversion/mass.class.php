<?php

declare(strict_types=1); # commenting this out for now

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
     * Processes the digital storage conversions
     * 
     * @param string $value
     * @param string $from_unit
     * @param string $to_unit
     * @return float
     */
    public function convertMass(float $value, string $from_unit, string $to_unit) {
        $this->value = self::convertToKilograms($value, $from_unit, $to_unit);
        $this->processedValue = self::convertFromKilograms($this->value, $to_unit, $from_unit);
        return $this->processedValue;
    }

    /**
     * Converts other storage formats to bits
     * 
     * @param float $value
     * @param string $from_unit
     * @return float|string
     */
    private static function convertToKilograms(float $value, string $from_unit) {
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
    private static function convertFromKilograms(float $value, string $to_unit) {
        switch (array_key_exists($to_unit, self::CONVERSION_ARRAY)) :
            case false:
                throw new \conversion\ConversionError(UNSUPPORTED . ': ' . $to_unit);
            default:
                return self::calculate($value, $to_unit, self::CONVERSION_ARRAY, 'divide');
        endswitch;
    }

}
