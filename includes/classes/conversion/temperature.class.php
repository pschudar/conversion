<?php

declare(strict_types=1);

namespace conversion;

/**
 * Temperature
 * 
 * Utilizes \conversion\Length::CONVERSION_ARRAY by stripping 'square_' from the 
 * array key. 
 * 
 * Results are calculated differently for Temperature and as such, the class does not
 * utilize the \calc\Calculate trait. Instead, it contains its own methods for
 * the conversion.
 * 
 * @category temperature
 * @package conversion
 * @author Paul Schudar
 * @copyright Copyright (c) 2020, Paul Schudar
 * @license https://opensource.org/licenses/mit-license.php MIT License
 * @internal Common Unit: Celsius
 */
class Temperature {

    const CONVERSION_ARRAY = [
        'celsius' => 'not_applicable',
        'fahrenheit' => 'not_applicable',
        'kelvin' => 'not_applicable',
        'rankine' => 'not_applicable'
    ];
    
    const INVALID = 'Enter a valid value';

    /**
     * Holds the value of the converted to_unit value
     * 
     * @var float 
     */
    private static $convertedTo;

    /**
     * Holds the value of the converted from_unit value
     * 
     * @var float 
     */
    private static $convertedFrom;

    /**
     * Processes the temperature conversions
     * 
     * @param string $value
     * @param string $from_unit
     * @param string $to_unit
     * @return float
     */
    public function processConversion(float $value, string $from_unit, string $to_unit) {
        self::$convertedTo = self::convertToUnit($value, $from_unit, $to_unit);
        self::$convertedFrom = self::convertFromUnit(self::$convertedTo, $to_unit, $from_unit);
        return self::$convertedFrom;
    }

    /**
     * Converts other temperature formats to celsius / centigrade
     * 
     * @param float $value
     * @param string $from_unit
     * @return float|string
     */
    private static function convertToUnit(float $value, string $from_unit) {
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
                    throw new \utility\ConversionError(UNSUPPORTED . ': ' . $from_unit);
            endswitch;
        } throw new \conversion\ConversionError(INVALID);
    }

    /**
     * Converts Celsius / centigrade to other formats
     * 
     * @param float $value
     * @param string $to_unit
     * @return float|string
     * @throws \utility\ConversionError
     */
    private static function convertFromUnit(float $value, string $to_unit) {
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
                    throw new \utility\ConversionError(UNSUPPORTED . ': ' . $to_unit);
            endswitch;
        } throw new \utility\ConversionError(INVALID);
    }

}
