<?php

declare(strict_types=1);

namespace conversion;

/**
 * DigitalStorage
 * 
 * @category digital storage
 * @package conversion
 * @author Paul Schudar
 * @copyright Copyright (c) 2020, Paul Schudar
 * @license https://opensource.org/licenses/mit-license.php MIT License
 * @internal Common Unit: bits (binary 1024)
 * @todo Add a section for decimal 1000
 */
class DigitalStorage {

    use \calc\Calculate;

    const CONVERSION_ARRAY = [
        'bits' => 1,
        'bytes' => 8,
        'kilobytes' => 8192,
        'megabytes' => 8388608,
        'gigabytes' => 8589934592,
        'terabytes' => 8796093022208,
        'petabytes' => 9007199254740600
    ];

    /**
     * Processes the conversion
     * 
     * @param string $value
     * @param string $from_unit
     * @param string $to_unit
     * @return float
     */
    public function processConversion(float $value, string $from_unit, string $to_unit) {
        return self::processConversions($value, $from_unit, $to_unit);
    }

}
