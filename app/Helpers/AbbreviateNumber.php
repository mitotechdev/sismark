<?php
namespace App\Helpers;

 
class AbbreviateNumber {
    public static function abbreviate($number) {
        $abbreviations = array(12 => 'T', 9 => 'M', 6 => 'JT', 3 => 'RB', 0 => '');
            foreach ($abbreviations as $exponent => $abbreviation) {
                if ($number >= pow(10, $exponent)) {
                    $formattedNumber = $number / pow(10, $exponent);
                    $formattedNumber = number_format($formattedNumber, 1); // Adjust the number of decimal places as needed
                    return $formattedNumber . $abbreviation;
                }
            }
            return $number;
    }
}