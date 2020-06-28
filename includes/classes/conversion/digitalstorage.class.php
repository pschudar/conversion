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
     * @internal Common Unit: Bits (binary 1024)
     * @todo Add decimal 1000
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
