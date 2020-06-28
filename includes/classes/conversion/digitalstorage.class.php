<?php

declare(strict_types=1);

namespace conversion;

class DigitalStorage {
    
    use \calc\Calculate;

    const CONVERSION_ARRAY = [
        'bits' => 1,
        'bytes' => 8,
        'kilobytes' => 8192,
        'megabytes' => 8388608,
        'gigabytes' => 8589934592,
        'terabytes' => 8796093022208,
        'petabytes' => 9007199254740600
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
    public function convertStorage(float $value, string $from_unit, string $to_unit) {
        $this->value = self::convertToBits($value, $from_unit, $to_unit);
        $this->processedValue = self::convertFromBits($this->value, $to_unit, $from_unit);
        return $this->processedValue;
    }

    /**
     * Converts other storage formats to bits
     * 
     * @param float $value
     * @param string $from_unit
     * @return float|string
     */
    private static function convertToBits(float $value, string $from_unit) {
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
    private static function convertFromBits(float $value, string $to_unit) {
        switch (array_key_exists($to_unit, self::CONVERSION_ARRAY)) :
            case false:
                throw new \conversion\ConversionError(UNSUPPORTED . ': ' . $to_unit);
            default:
                return self::calculate($value, $to_unit, self::CONVERSION_ARRAY, 'divide');
        endswitch;
    }

}
