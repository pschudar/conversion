<?php

declare(strict_types=1);

namespace utility;

class Utility {

    /**
     * Runs a string through htmlspecialchars()
     * 
     * Provides easy access to an otherwise lengthy function name.
     * 
     * @internal : Utility
     * @param string $string
     * @return string
     */
    public static function h(string $string = '') {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Determines if the request was a post request
     * 
     * @internal : Utility
     * @return bool
     */
    public static function isPostRequest() {
        return strtolower(SERVER_REQUEST_METHOD) == 'post';
    }

    /**
     * Determines if the request was an ajax request
     * 
     * @internal : Utility
     * @return Boolean
     */
    public static function isAjaxRequest() {
        return !empty(HTTP_XRW) &&
                strtolower(HTTP_XRW) == 'xmlhttprequest';
    }

    /**
     * Processes a string by removing blank spaces and replacing them with underscores
     * 
     * @internal : Utility
     * @param string $string
     * @return string
     */
    public static function optionize(string $string) {
        return str_replace(' ', '_', strtolower($string));
    }

    /**
     * Creates and populates Select list <code><option></option></code> tags
     * 
     * Accepts $unit from foreach loop, $opt is the return value from the 
     * optionize function, from_to_unit is from_unit or to_unit
     * 
     * @internal : Utility
     * @param string $unit
     * @param string $opt
     * @param string $from_to_unit
     * @return string
     */
    public static function optionizer(string $unit, string $opt, string $from_to_unit) {
        $list = "<option value=\"{$opt}\"";
        if ($from_to_unit == $opt) {
            $list .= " selected";
        }
        $list .= ">{$unit}</option>";
        return $list;
    }

    /**
     * Formats a float to a string while avoiding default use of scientific notation
     * 
     * Rounds to $precision and trims extra trailing zeros
     * 
     * @internal : Utility
     * @param float $float
     * @param int $precision
     * @return string
     */
    public static function floatToString($float, $precision = 10) {
        # Typecast to ensure value is a float
        $float = (float) $float;
        $string = number_format($float, $precision, '.', '');
        $string = rtrim($string, '0');
        $string = rtrim($string, '.');
        return $string;
    }

}
