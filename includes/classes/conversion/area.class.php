<?php

declare(strict_types=1);

namespace conversion;

/**
 * Area
 * 
 * Utilizes \conversion\Length::CONVERSION_ARRAY 
 * 
 * Results are calculated differently for Area and as such, the class does not
 * utilize the \calc\Calculate trait. Instead, it contains its own methods for
 * the conversion.
 * 
 * @category area
 * @package conversion
 * @author Paul Schudar
 * @copyright Copyright (c) 2020, Paul Schudar
 * @license https://opensource.org/licenses/mit-license.php MIT License
 * @internal Common Unit: Square meters
 */
class Area {

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
     * Processes the conversions
     * 
     * @internal Common Unit: seconds
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
     * Compiles a list of array keys, prefixes 'square_' to the key name.
     * 
     * @return array
     */
    public function selectOptions() {

        $array_keys = array_keys(\conversion\Length::CONVERSION_ARRAY);

        foreach ($array_keys as $area_key):

            switch ($area_key) :
                case 'acres':
                case 'hectares':
                    $area_options[] = $area_key;
                    break;
                default:
                    $area_options[] = 'square_' . $area_key;
            endswitch;

        endforeach;

        return $area_options;
    }

    /**
     * Converts other storage formats to square meters
     * 
     * @param float $value
     * @param string $from_unit
     * @return float|string
     */
    private static function convertToUnit(float $value, string $from_unit) {
        # removes 'square_' from the from_unit value & utilizes \conversion\Length::CONVERSION_ARRAY
        $fromUnitValue = str_replace('square_', '', $from_unit);
        switch (array_key_exists($fromUnitValue, \conversion\Length::CONVERSION_ARRAY)) :
            case false:
                throw new \utility\ConversionError(UNSUPPORTED . ': ' . $from_unit);
            default:
                return self::calculate($value, $fromUnitValue, \conversion\Length::CONVERSION_ARRAY, 'multiply');
        endswitch;
    }

    /**
     * Converts square meters to other formats
     * 
     * @param float $value
     * @param string $to_unit
     * @return float|string
     */
    private static function convertFromUnit(float $value, string $to_unit) {
        $to_unit = str_replace('square_', '', $to_unit);
        switch (array_key_exists($to_unit, \conversion\Length::CONVERSION_ARRAY)) :
            case false:
                throw new \utility\ConversionError(UNSUPPORTED . ': ' . $to_unit);
            default:
                return self::calculate($value, $to_unit, \conversion\Length::CONVERSION_ARRAY, 'divide');
        endswitch;
    }

    /**
     * Crunches the numbers and returns the value requested
     * 
     * This method begins by ensuring that $value is a floating point number.
     * If so, it checks that $value exists within the array $constant.
     * Then, the calculation is performed and returned.
     * If the $unit is not a supported unit, the user is notified.
     * If $value is not a floating point number, a new TypeError is thrown.
     * 
     * For the moment, I removed the use \calc\Calculate; statement and 
     * directly wrote the following two methods in as the operate method
     * works differently for every other class. This is subject to change
     * at any given moment.
     * 
     * @param float $value
     * @param string $unit
     * @param array $constant
     * @param string $calculation
     * @return float|string
     * @throws TypeError
     */
    private static function calculate(float $value, string $unit, array $constant, string $calculation) {
        switch (is_float($value)) :
            case true:
                return self::operate($value, $unit, $constant, $calculation);
            default:
                throw new \TypeError();
        endswitch;
    }

    /**
     * Determines whether to multiply or divide for the conversion calculation
     * 
     * @param float $value
     * @param string $unit
     * @param array $const
     * @param string $calc
     * @return float|string
     * @throws \utility\ConversionError
     */
    private static function operate(float $value, string $unit, array $const, string $calc) {
        if (array_key_exists($unit, $const)) :
            switch ($calc) :
                case 'divide':
                    return $value / pow($const[$unit], 2);
                case 'multiply':
                    return $value * pow($const[$unit], 2);
            endswitch;
        else :
            throw new \utility\ConversionError(UNSUPPORTED . ': ' . $unit);
        endif;
    }

}
