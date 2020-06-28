<?php

# enable output buffering
ob_start();

/**
 * Assign file paths to some constants
 * 
 * __FILE__ will return the path to -this- file
 * dirname() returns the path to the parent directory
 */
define('INCLUDE_PATH', dirname(__FILE__));
define('SHARED_PATH', INCLUDE_PATH . DIRECTORY_SEPARATOR . 'shared' . DIRECTORY_SEPARATOR);

/**
 * Conversion Tool automatic class loader 
 * 
 * Auto-magically loads classes without having to specifically require them.
 * Will work on Windows, Linux, Mac, etc.
 * 
 * @param class $class
 */
function ct_autoload($class) {
    $filename = INCLUDE_PATH . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, strtolower($class)) . '.class.php';
    if (file_exists($filename) && is_readable($filename)) :
        require_once($filename);
    endif;
}

/**
 * Register the autoload function
 */
spl_autoload_register('ct_autoload');

require_once(SHARED_PATH . 'constants.php');
require_once(SHARED_PATH . 'default-values.php');
