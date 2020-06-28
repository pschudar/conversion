<?php

namespace conversion;

class ConversionError extends \Exception {

    public $message;
    
    public function __construct($message) {
        $this->message = $message;
    }

    public function fetchMessage() {
        return $this->message;
    }

}
