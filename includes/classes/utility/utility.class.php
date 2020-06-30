<?php

declare(strict_types=1);

namespace utility;

/**
 * Utility
 * 
 * Provides a container in which to hold validation and misc methods
 * 
 * @category utility
 * @package conversion
 * @author Paul Schudar
 * @copyright Copyright (c) 2020, Paul Schudar
 * @license https://opensource.org/licenses/mit-license.php MIT License
 */
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
     * Processes a string by removing underscores and replacing them with a space
     * 
     * Used to clean up the viewable text in select drop down lists.
     * This is a good fix for the issue but I may update it later.
     * 
     * @param string $string
     * @return string
     */
    public static function selectionize(string $string) {
        return str_replace('_', ' ', strtolower($string));
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
        $filteredOption = self::h($opt);
        $list = "<option value=\"{$filteredOption}\"";
        if ($from_to_unit == $opt) {
            $list .= " selected";
        }
        $new = self::selectionize($unit);
        $newUnit = self::h($new);
        $list .= ">{$newUnit}</option>";
        return $list;
    }

    /**
     * Formats a float to a string while avoiding default use of scientific notation
     * 
     * Rounds to $precision and trims extra trailing zeros
     * 
     * @internal : Utility
     * @param string $float
     * @param int $precision
     * @return string
     */
    public static function floatToString(string $float, int $precision = 10) {
        # Typecast to ensure value is a float
        $cast = (float) $float;
        $formatted = number_format($cast, $precision, '.', '');
        $str = rtrim($formatted, '0');
        $string = rtrim($str, '.');
        return $string;
    }

}
