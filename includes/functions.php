<?php

/**
 * Filters Super-global _SERVER['REQUEST_METHOD'] with FILTER_SANITIZE_FULL_SPECIAL_CHARS (id: 522)
 * 
 * @var string
 */
$server_request_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', 522);
/**
 * Constant that uses $server_request_method's value
 * 
 * Possible values include, but are not limited to: GET, POST, or REQUEST
 * @var string
 */
define('SERVER_REQUEST_METHOD', $server_request_method);
/**
 * Filters Super-globa _SERVER['HTTP_X_REQUESTED_WITH'] with FILTER_SANITIZE_STRING (id: 513)
 * 
 * @var string
 */
$server_http_xrw = filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH', 513); # XMLHttpRequest
/**
 * Constat that uses $server_http_xrw's value
 * 
 * Possible values include XMLHttpRequest
 */
define('HTTP_XRW', $server_http_xrw);

/**
 * Constant that holds an array of values necessary for converting length types to meters
 * 
 * @var array
 */
const LENGTH_TO_METER = [
    'inches' => 0.0254,
    'feet' => 0.3048,
    'yards' => 0.9144,
    'miles' => 1609.344,
    'millimeters' => 0.001,
    'centimeters' => 0.01,
    'meters' => 1,
    'kilometers' => 1000,
    'acres' => 63.614907234075,
    'hectares' => 100,
    'nautical_miles' => 1852
];

/**
 * Constant that holds an array of values necessary for converting volume to liter
 * 
 * @var array
 */
const VOLUME_TO_LITER = [
    'cubic_inches' => 0.0163871,
    'cubic_feet' => 28.3168,
    'cubic_centimeters' => 0.001,
    'cubic_meters' => 1000,
    'imperial_gallons' => 4.54609,
    'imperial_quarts' => 1.13652,
    'imperial_pints' => 0.568261,
    'imperial_cups' => 0.284131,
    'imperial_ounces' => 0.0284131,
    'imperial_tablespoons' => 0.0177582,
    'imperial_teaspoons' => 0.00591939,
    'us_gallons' => 3.78541,
    'us_quarts' => 0.946353,
    'us_pints' => 0.473176,
    'us_cups' => 0.24,
    'us_ounces' => 0.0295735,
    'us_tablespoons' => 0.0147868,
    'us_teaspoons' => 0.00492892,
    'liters' => 1,
    'milliliters' => 0.001,
];

/**
 * Constant that holds an array of values necessary for converting mass to kilograms
 * 
 * @var array
 */
const MASS_TO_KILOGRAM = [
    'ounces' => 0.0283495,
    'pounds' => 0.453592,
    'stones' => 6.35029,
    'long_tons' => 1016.05,
    'short_tons' => 907.185,
    'milligrams' => 0.000001,
    'grams' => 0.001,
    'kilograms' => 1,
    'metric_tonnes' => 1000
];

/**
 * Constant used as a return value in many different functions. 
 * 
 * This simply provides an easy way to offer up a uniform message across the board.
 * @var string
 */
const UNSUPPORTED = 'Unsupported Unit';

/**
 * Determines if the request was a post request
 * @return bool
 */
function is_post_request() {
    return SERVER_REQUEST_METHOD == 'POST';
}

function is_ajax_request() {
    return !empty(HTTP_XRW) &&
      strtolower(HTTP_XRW) == 'xmlhttprequest';
  }

function optionize($string) {
    return str_replace(' ', '_', strtolower($string));
}

/**
 * Accepts unit from foreach loop, opt is from optionize function, from_to_unit is from_unit or to_unit
 * @param type $unit
 * @param type $opt
 * @param type $from_to_unit
 * @return type
 */
function optionizer($unit, $opt, $from_to_unit) {
    $list = "<option value=\"{$opt}\"";
    if ($from_to_unit == $opt) {
        $list .= " selected";
    }
    $list .= ">{$unit}</option>";
    return $list;
}

// The function float_to_string formats a float into a string 
// while also avoiding default use of scientific notation.
// Rounds to $precision and trims extra trailing zeros.
function float_to_string($float, $precision = 10) {
    // Typecast to ensure value is a float
    $float = (float) $float;
    $string = number_format($float, $precision, '.', '');
    $string = rtrim($string, '0');
    $string = rtrim($string, '.');
    return $string;
}

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

// Mass
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

function convert_mass(string $value, string $from_unit, string $to_unit) {
    $kg_value = convert_to_kilograms($value, $from_unit);
    $new_value = convert_from_kilograms($kg_value, $to_unit);
    return $new_value;
}

// Speed
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

// Temperature
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

function convert_temperature(string $value, string $from_unit, string $to_unit) {
    $celsius_value = convert_to_celsius($value, $from_unit);
    $new_value = convert_from_celsius($celsius_value, $to_unit);
    return $new_value;
}

/**
 * Runs a string through htmlspecialchars()
 * 
 * Provides easy access to an otherwise lengthy function name.
 * @internal Utility function
 * @param string $string
 * @return string
 */
function h($string = '') {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
