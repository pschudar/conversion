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
 * Filters Super-global _SERVER['HTTP_X_REQUESTED_WITH'] with FILTER_SANITIZE_STRING (id: 513)
 * 
 * @var string
 */
$server_http_xrw = filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH', 513); # XMLHttpRequest
/**
 * Constant that uses $server_http_xrw's value
 * 
 * Possible values include XMLHttpRequest
 */
define('HTTP_XRW', $server_http_xrw);
/**
 * Filters Super-global _SERVER['PHP_SELF'] with _FULL_SPECIAL_CHARS (id: 522)
 */
$php_self = filter_input(INPUT_SERVER, 'PHP_SELF', 522);
/**
 * Constant that utilizes $php_self's value for the main form action attribute
 * 
 * @var string
 */
define('PHP_SELF', $php_self);

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
