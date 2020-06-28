<?php

namespace calc;

trait Calculate {

    /**
     * Crunches the numbers and returns the value requested
     * 
     * This method begins by ensuring that $value is a floating point number.
     * If so, it checks that $value exists within the array $constant.
     * Then, the calculation is performed and returned.
     * If the $unit is not a supported unit, the user is notified.
     * If $value is not a floating point number, a new TypeError is thrown.
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
     * Determines whether to multiply or divide for the conversion
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
                    return $value / $const[$unit];
                case 'multiply':
                    return $value * $const[$unit];
            endswitch;
        else :
            throw new \utility\ConversionError(UNSUPPORTED . ': ' . $unit);
        endif;
    }

    /**
     * Converts unit to the common unit used
     * 
     * @param float $value
     * @param string $from_unit
     * @return float|string
     */
    private static function convertToUnit(float $value, string $from_unit) {
        switch (array_key_exists($from_unit, self::CONVERSION_ARRAY)) :
            case false:
                throw new \utility\ConversionError(UNSUPPORTED . ': ' . $from_unit);
            default:
                return self::calculate($value, $from_unit, self::CONVERSION_ARRAY, 'multiply');
        endswitch;
    }

    /**
     * Converts the common unit to other formats
     * 
     * @param float $value
     * @param string $to_unit
     * @return float|string
     */
    private static function convertFromUnit(float $value, string $to_unit) {
        switch (array_key_exists($to_unit, self::CONVERSION_ARRAY)) :
            case false:
                throw new \utility\ConversionError(UNSUPPORTED . ': ' . $to_unit);
            default:
                return self::calculate($value, $to_unit, self::CONVERSION_ARRAY, 'divide');
        endswitch;
    }

}
