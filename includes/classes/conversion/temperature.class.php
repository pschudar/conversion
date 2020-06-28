<?php

declare(strict_types=1);

namespace conversion;

class Temperature {

    const CONVERSION_ARRAY = [
        'celsius' => 'x',
        'fahrenheit' => 'x',
        'kelvin' => 'x',
        'rankine' => 'x'
    ];

    private $value;
    private $processedValue;

    /**
     * Processes the temperature conversions
     * 
     * @param string $value
     * @param string $from_unit
     * @param string $to_unit
     * @return float
     */
    public function convertTemperature(float $value, string $from_unit, string $to_unit) {
        $this->value = self::convertToCelsius($value, $from_unit, $to_unit);
        $this->processedValue = self::convertFromCelsius($this->value, $to_unit, $from_unit);
        return $this->processedValue;
    }

    /**
     * Converts other temperature formats to celsius / centigrade
     * 
     * @param float $value
     * @param string $from_unit
     * @return float|string
     */
    private static function convertToCelsius(float $value, string $from_unit) {
        if (is_float($value)) {
            switch ($from_unit) :
                case 'celsius':
                    return $value;
                case 'fahrenheit':
                    return ($value - 32) / 1.8;
                case 'kelvin':
                    return $value - 273.15;
                case 'rankine':
                    return ($value - 491.67) * (5 / 9);
                default:
                    throw new \conversion\ConversionError(UNSUPPORTED . ': ' . $from_unit);
            endswitch;
        } throw new \conversion\ConversionError('Enter a valid value');
    }

    /**
     * Converts celsius / centigrade  to other formats
     * 
     * @param float $value
     * @param string $to_unit
     * @return float|string
     */
    private static function convertFromCelsius(float $value, string $to_unit) {
        if (is_float($value)) {
            switch ($to_unit) :
                case 'celsius':
                    return $value;
                case 'fahrenheit':
                    return ($value * 1.8) + 32;
                case 'kelvin':
                    return $value + 273.15;
                case 'rankine':
                    return ($value * (9 / 5) + 491.67);
                default:
                    throw new \conversion\ConversionError(UNSUPPORTED . ': ' . $to_unit);
            endswitch;
        } throw new \conversion\ConversionError('Enter a valid value');
    }

}
