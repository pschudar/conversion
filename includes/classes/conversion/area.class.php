<?php

declare(strict_types=1); # commenting this out for now

namespace conversion;

class Area {

    # uses same conversion array as Length
    private $value;
    private $processedValue;

    /**
     * Processes the area conversions
     * 
     * @param string $value
     * @param string $from_unit
     * @param string $to_unit
     * @return float
     */
    public function convertArea(float $value, string $from_unit, string $to_unit) {
        $this->value = self::convertToSquareMeters($value, $from_unit, $to_unit);
        $this->processedValue = self::convertFromSquareMeters($this->value, $to_unit, $from_unit);
        return $this->processedValue;
    }

    /**
     * Converts other storage formats to square meters
     * 
     * @param float $value
     * @param string $from_unit
     * @return float|string
     */
    private static function convertToSquareMeters(float $value, string $from_unit) {
        # removes 'square_' from the from_unit value & utilizes \conversion\Length::CONVERSION_ARRAY
        $from_unit = str_replace('square_', '', $from_unit);
        switch (array_key_exists($from_unit, \conversion\Length::CONVERSION_ARRAY)) :
            case false:
                throw new \conversion\ConversionError(UNSUPPORTED . ': ' . $from_unit);
            default:
                return self::calculate($value, $from_unit, \conversion\Length::CONVERSION_ARRAY, 'multiply');
        endswitch;
    }

    /**
     * Converts square meters to other formats
     * 
     * @param float $value
     * @param string $to_unit
     * @return float|string
     */
    private static function convertFromSquareMeters(float $value, string $to_unit) {
        $to_unit = str_replace('square_', '', $to_unit);
        switch (array_key_exists($to_unit, \conversion\Length::CONVERSION_ARRAY)) :
            case false:
                throw new \conversion\ConversionError(UNSUPPORTED . ': ' . $to_unit);
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
     * Determines whether to multiply or divide for the particular conversion
     * 
     * @param float $value
     * @param string $unit
     * @param array $const
     * @param string $calc
     * @return float|string
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
            return UNSUPPORTED;
        endif;
    }

}
