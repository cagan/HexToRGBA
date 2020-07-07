<?php

namespace App;

use Exception;
use InvalidArgumentException;

class HexToRGBAConverter {

// 16 * x + y = 6 basamakli
// 17x = 3 basamakli

    public static function convert(string $hexcode, $alpha = 1)
    {
        if (strpos($hexcode, '#') > 0) {
            throw new Exception('Invalid hex code');
        }

        if (substr($hexcode, 0, 1) === '#') {
            $hexcode = substr($hexcode, 1);
        }

        $hexcode = str_split($hexcode);
        $hexcodeLength = sizeof($hexcode);

        if ($hexcodeLength !== 3 && $hexcodeLength !== 6) {
            throw new Exception("Invalid hex code");
        }

        if($alpha < 0 || $alpha > 1){
            throw new InvalidArgumentException("Alpha must be between 0 and 1");
        }

        $rgb = [];
        $hexCodeMap = [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 7,
            8 => 8,
            9 => 9,
            'A' => 10,
            'B' => 11,
            'C' => 12,
            'D' => 13,
            'E' => 14,
            'F' => 15,
        ];

        $incrementer = $hexcodeLength === 3 ? 1 : 2;

        for ($i = 0; $i < $hexcodeLength; $i += $incrementer) {
            $hexDigits = array_slice($hexcode, $i, $incrementer);

            if (sizeof($hexDigits) === 1) {
                $rgb[] = intval($hexCodeMap[strtoupper($hexDigits[0])]) * 17;
            } else {
                $firstDigit = intval($hexCodeMap[strtoupper($hexDigits[0])]);
                $secondDigit = intval($hexCodeMap[strtoupper($hexDigits[1])]);

                $rgb[] = 16 * intval($firstDigit) + intval($secondDigit);
            }
        }

        if ($alpha < 1 && $alpha > 0) {
            $alpha = trim($alpha, '0');
        }

        return "rgba(" . implode(', ', $rgb) . ', ' . $alpha . ")";
    }

}

