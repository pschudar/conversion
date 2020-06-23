<?php

/**
 * Converts other formats to meters
 * 
 * @internal : Length
 * @param float $value
 * @param string $from_unit
 * @return string
 * @throws TypeError
 */
function convert_to_meters(float $value, string $from_unit) {
    switch (is_float($value)) :
        case true:
            if (array_key_exists($from_unit, LENGTH_TO_METER)) {
                return $value * LENGTH_TO_METER[$from_unit];
            } else {
                return UNSUPPORTED;
            }
            break;
        default:
            throw new TypeError();
    endswitch;
}

/**
 * Converts meters to other formats
 * 
 * @internal : Length
 * @param float $value
 * @param string $to_unit
 * @return type
 * @throws TypeError
 */
function convert_from_meters(float $value, string $to_unit) {
    switch (is_float($value)) :
        case true:
            if (array_key_exists($to_unit, LENGTH_TO_METER)) {
                return $value / LENGTH_TO_METER[$to_unit];
            } else {
                return UNSUPPORTED;
            }
            break;
        default:
            throw new TypeError();
    endswitch;
}

/**
 * Processes the length conversions
 * 
 * @internal : Length
 * @param string $value
 * @param string $from_unit
 * @param string $to_unit
 * @return float|int
 */
function convert_length(string $value, string $from_unit, string $to_unit) {
    $meter_value = convert_to_meters($value, $from_unit);
    $new_value = convert_from_meters($meter_value, $to_unit);
    return $new_value;
}

/**
 * Converts other formats to square meters
 * 
 * @internal : Area
 * @param float $value
 * @param type $from_unit
 * @return type
 * @throws TypeError
 */
function convert_to_square_meters(float $value, string $from_unit) {
    # removes 'square_' from the from_unit value & utilizes LENGTH_TO_METER constant
    $from_unit = str_replace('square_', '', $from_unit);
    switch (is_numeric($value)) :
        case true:
            if (array_key_exists($from_unit, LENGTH_TO_METER)) {
                return $value * pow(LENGTH_TO_METER[$from_unit], 2);
            } else {
                return UNSUPPORTED;
            }
            break;
        default:
            throw new TypeError();
    endswitch;
}

/**
 * Converts square meters to other formats
 * 
 * @internal : Area
 * @param float $value
 * @param string $to_unit
 * @return type
 * @throws TypeError
 */
function convert_from_square_meters(float $value, string $to_unit) {
    # removes 'square_' from the to_unit value & utilizes LENGTH_TO_METER constant
    $to_unit = str_replace('square_', '', $to_unit);
    # checks that $value is numeric
    switch (is_numeric($value)) :
        case true:
            # checks that $to_unit exists within LENGTH_TO_METER constant
            if (array_key_exists($to_unit, LENGTH_TO_METER)) {
                # returns result of mathematical calculation
                return $value / pow(LENGTH_TO_METER[$to_unit], 2);
            } else {
                # returns string noting an unsupported format
                return UNSUPPORTED;
            }
            break;
        default:
            # if $value is not numeric, a TypeError is thrown
            throw new TypeError();
    endswitch;
}

/**
 * Processes the Area conversions
 * 
 * @param string $value
 * @param string $from_unit
 * @param string $to_unit
 * @return float
 */
function convert_area(string $value, string $from_unit, string $to_unit) {
    $meter_value = convert_to_square_meters($value, $from_unit);
    $new_value = convert_from_square_meters($meter_value, $to_unit);
    return $new_value;
}

/**
 * Converts other formats to liters
 * 
 * @internal : Volume
 * @param float $value
 * @param string $from_unit
 * @return type
 * @throws TypeError
 */
function convert_to_liters(float $value, string $from_unit) {
    switch (is_numeric($value)) :
        case true:
            if (array_key_exists($from_unit, VOLUME_TO_LITER)) {
                return $value * VOLUME_TO_LITER[$from_unit];
            } else {
                return UNSUPPORTED;
            }
            break;
        default:
            throw new TypeError();
    endswitch;
}

/**
 * Converts liters to other formats
 * 
 * @internal : Volume
 * @param float $value
 * @param string $to_unit
 * @return string
 * @throws TypeError
 */
function convert_from_liters(float $value, string $to_unit) {
    switch (is_numeric($value)) :
        case true:
            if (array_key_exists($to_unit, VOLUME_TO_LITER)) {
                return $value / VOLUME_TO_LITER[$to_unit];
            } else {
                return UNSUPPORTED;
            }
            break;
        default:
            throw new TypeError();
    endswitch;
}

/**
 * Processes the volume conversions
 * 
 * @internal : Volume
 * @param string $value
 * @param string $from_unit
 * @param string $to_unit
 * @return float
 */
function convert_volume(string $value, string $from_unit, string $to_unit) {
    $liter_value = convert_to_liters($value, $from_unit);
    $new_value = convert_from_liters($liter_value, $to_unit);
    return $new_value;
}

/**
 * Converts weight or mass measurements to kilograms
 * 
 * @internal : Mass
 * @param float $value
 * @param string $from_unit
 * @return type
 * @throws TypeError
 */
function convert_to_kilograms(float $value, string $from_unit) {
    switch (is_numeric($value)) :
        case true:
            if (array_key_exists($from_unit, MASS_TO_KILOGRAM)) {
                return $value * MASS_TO_KILOGRAM[$from_unit];
            } else {
                return UNSUPPORTED;
            }
            break;
        default:
            throw new TypeError();
    endswitch;
}

/**
 * Converts other weight or mass measurements from KG to other formats
 * @internal : Mass
 * @param float $value
 * @param string $to_unit
 * @return type
 * @throws TypeError
 */
function convert_from_kilograms(float $value, string $to_unit) {
    switch (is_numeric($value)) :
        case true:
            if (array_key_exists($to_unit, MASS_TO_KILOGRAM)) {
                return $value / MASS_TO_KILOGRAM[$to_unit];
            } else {
                return UNSUPPORTED;
            }
            break;
        default:
            throw new TypeError();
    endswitch;
}

/**
 *  Processes the mass conversions
 * 
 * @internal : Mass
 * @param string $value
 * @param string $from_unit
 * @param string $to_unit
 * @return type
 */
function convert_mass(string $value, string $from_unit, string $to_unit) {
    $kg_value = convert_to_kilograms($value, $from_unit);
    $new_value = convert_from_kilograms($kg_value, $to_unit);
    return $new_value;
}

/**
 * Converts speed measurements from one unit to the others
 * 
 * @internal : Speed
 * @param type $value
 * @param string $from_unit
 * @param string $to_unit
 * @return int
 */
function convert_speed($value, string $from_unit, string $to_unit) {
    if ($from_unit == 'knots') {
        $from_unit = 'nautical_miles_per_hour';
    }
    if ($to_unit == 'knots') {
        $to_unit = 'nautical_miles_per_hour';
    }

    list($from_dist, $from_time) = explode('_per_', $from_unit);
    list($to_dist, $to_time) = explode('_per_', $to_unit);

    if ($from_time == 'hour') {
        $value /= 3600;
    }
    $value = convert_length($value, $from_dist, $to_dist);
    if ($to_time == 'hour') {
        $value *= 3600;
    }

    return $value;
}

/**
 * Converts other measurements to celsius / centigrade
 * 
 * @internal : Temperature
 * @param float $value
 * @param string $from_unit
 * @return float
 */
function convert_to_celsius(float $value, string $from_unit) {
    switch ($from_unit) {
        case 'celsius':
            return $value;
        case 'fahrenheit':
            return ($value - 32) / 1.8;
        case 'kelvin':
            return $value - 273.15;
        default:
            return UNSUPPORTED;
    }
}

/**
 * Converts celsius / centigrade to other formats
 * 
 * @internal : Temperature
 * @param float $value
 * @param string $to_unit
 * @return float
 */
function convert_from_celsius(float $value, string $to_unit) {
    switch ($to_unit) {
        case 'celsius':
            return $value;
        case 'fahrenheit':
            return ($value * 1.8) + 32;
        case 'kelvin':
            return $value + 273.15;
        default:
            return UNSUPPORTED;
    }
}

/**
 * Processes the temperature conversions
 * 
 * @internal : Temperature
 * @param string $value
 * @param string $from_unit
 * @param string $to_unit
 * @return type
 */
function convert_temperature(string $value, string $from_unit, string $to_unit) {
    $celsius_value = convert_to_celsius($value, $from_unit);
    $new_value = convert_from_celsius($celsius_value, $to_unit);
    return $new_value;
}
