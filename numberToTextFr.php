<?php

// function to convert a given number into words (french version)

function numberToText($number, $separator = '-', $isLast = true)
{
    $number = (int) $number;

    $units = [
        0 => 'zéro',
        1 => 'un',
        2 => 'deux',
        3 => 'trois',
        4 => 'quatre',
        5 => 'cinq',
        6 => 'six',
        7 => 'sept',
        8 => 'huit',
        9 => 'neuf',
        10 => 'dix',
        11 => 'onze',
        12 => 'douze',
        13 => 'treize',
        14 => 'quatorze',
        15 => 'quinze',
        16 => 'seize',
        17 => 'dix-sept',
        18 => 'dix-huit',
        19 => 'dix-neuf',
    ];

    $thens = [
        2 => 'vingt',
        3 => 'trente',
        4 => 'quarante',
        5 => 'cinquante',
        6 => 'soixante',
        7 => 'soixante',
        8 => 'quatre-vingt',
        9 => 'quatre-vingt',
    ];



    $pows = [
        1 => '',
        2 => 'mille',
        3 => 'million',
        4 => 'milliard',
        5 => 'billion',
        6 => 'billiard',
        7 => 'trillion',
        8 => 'trilliard',
        9 => 'quadrillion',
        10 => 'quadrilliard',
        11 => 'quintillion',
        12 => 'quintilliard',
    ];


    // from 0 to 99
    if($number < 100) {

        if($number < 20) {
            $result = $units[$number];
        } elseif($number >  69 && $number < 80) {
            $then = floor($number / 10);
            $unit = $number - 60;

            $unitText = $units[$unit];

            $result = $thens[$then] . ' ' . $unitText;
        } elseif($number >  79 && $number < 100) {
            $then = floor($number / 10);
            $unit = $number - 80;

            $unitText = '';
            if($unit > 0) {
                $unitText = $units[$unit];
            }

            $result = $thens[$then] . ' ' . $unitText;
        }

        else {
            $then = (int) ($number / 10);
            $unit = $number % 10;
            $text = $thens[$then];
            if($unit > 0) {
                $text .= ' ' . $units[$unit];
            }
            $result = $text;
        }

        $result = preg_replace('/([aeiouy]) ([aeiouy])/', '$1 et $2', $result);
        $result = trim($result);

        if($number == 80) {
            $result .= 's';
        }

        $result = str_replace(' ', $separator, $result);
        return $result;
    }


    // from 100 to 999
    if($number < 1000) {
        $then = (int) ($number / 100);
        $unit = $number % 100;

        $text = '';
        if($then > 1) {
            $text = $units[$then] . ' ';
        }
        $text .= 'cent';

        if($unit > 0) {
            $text .= ' ' . numberToText($unit, $separator, true);
        }

        // if($isLast && $then > 1 && $unit == 0) {
        //     $text .= 's';
        // }

        if($then > 1 && $unit == 0) {
            $text .= 's';
        }



        $text = str_replace(' ', $separator, $text);
        return $text;
    }

    // all other numbers
    $number = str_pad($number, 18, '0', STR_PAD_LEFT);
    $segments = str_split($number, 3);
    $nbSegments = count($segments);

    $segmentText = '';

    foreach($segments as $key => $segment) {
        $segmentNumber = (int) $segment;

        if($segmentNumber > 0) {

            if($nbSegments - $key > 2 || $segmentNumber > 1) {
                $segmentText .= ' ' . numberToText($segmentNumber, $separator, $key == $nbSegments - 1);
            }

            $segmentText .=  ' ' . $pows[$nbSegments - $key];
            if($segmentNumber > 1 && ($nbSegments - $key > 2)) {
                $segmentText .= 's';
            }
        }
    }

    $result = str_replace(' ', $separator, trim($segmentText));
    return $result;

}


echo numberToText(2000000) . "\n";
echo numberToText(2000) . "\n";

echo numberToText(200000) . "\n";
echo numberToText(211000) . "\n";

echo numberToText(80) . "\n";
echo numberToText(81) . "\n";

echo numberToText(80000) . "\n";
echo numberToText(8081880) . "\n";
echo numberToText(8081800) . "\n";

echo numberToText(800101) . "\n";
echo numberToText(800200) . "\n";
echo numberToText(800280) . "\n";
echo numberToText(821280) . "\n";


echo numberToText(7) . "\n";
echo numberToText(17) . "\n";
echo numberToText(51) . "\n";
echo numberToText(80) . "\n";
echo numberToText(81) . "\n";

echo numberToText(100) . "\n";
echo numberToText(101) . "\n";

echo numberToText(200) . "\n";
echo numberToText(201) . "\n";

echo numberToText(100200) . "\n";
echo numberToText(100201) . "\n";

echo numberToText(710201) . "\n";

echo numberToText(51510551) . "\n";


// echo numberToText(99) . "\n";
// echo numberToText(100) . "\n";
// echo numberToText(999) . "\n";

// echo numberToText(999) . "\n";
// echo numberToText(9999) . "\n";

// echo numberToText(19999) . "\n";

// echo numberToText(119999) . "\n";

// echo numberToText(10000) . "\n";
// echo numberToText(100000) . "\n";

// echo numberToText(999999999) . "\n";

// echo numberToText(199999999) . "\n";

// echo numberToText(1999999) . "\n";

// echo numberToText(1000) . "\n";
// echo numberToText(100) . "\n";

// echo numberToText(9001000) . "\n";
// echo numberToText(9021000) . "\n";



// echo numberToText(51510551) . "\n";

// echo numberToText(1000) . "\n";
// echo numberToText(1000000) . "\n";



// echo numberToText(51) . "\n";
// echo numberToText(71) . "\n";

// echo numberToText(51051) . "\n";
// echo numberToText(80000) . "\n";


// for($i = 9000; $i < 10197; $i++) {
//     echo "[ $i ] ".numberToText($i) . "\n";
// }


// echo numberToText(28) ." Août ". numberToText(2023) . "\n";