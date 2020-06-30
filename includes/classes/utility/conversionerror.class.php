<?php

namespace utility;

/**
 * ConversionError
 * 
 * Provides a simple means throw a custom error
 * 
 * @category utility
 * @package conversion
 * @author Paul Schudar
 * @copyright Copyright (c) 2020, Paul Schudar
 * @license https://opensource.org/licenses/mit-license.php MIT License
 */
class ConversionError extends \Exception {

    public $message;
    
    public function __construct($message) {
        $this->message = $message;
    }

    public function fetchMessage() {
        return $this->message;
    }

}
