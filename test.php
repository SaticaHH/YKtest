<?php

function binarySearch($file, $search_value)
{
    $handle = fopen($file, "r");
    while (!feof($handle)) {
        $string = fgets($handle, 4000);
        mb_convert_encoding($string, 'cp1251');
        $explodedstring = explode('\x0A', $string);
        array_pop($explodedstring);
        foreach ($explodedstring as $key => $value) {
            $arr[] = explode('\t', $value);
        }
        $start = 0;
        $end = count($arr) - 1;
        while ($start <= $end) {
            $calc_mid = floor(($start + $end) / 2);
            $strnatcmp = strnatcmp($arr[$calc_mid][0], $search_value); // function strnatcmp ($str1, $str2) {}
            if ($strnatcmp > 0) {
                $end = $calc_mid - 1;
            } elseif ($strnatcmp < 0) {
                $start = $calc_mid + 1;
            } else {
                return $arr[$calc_mid][1];
            }
        }
    }
    return 'undef';
}
}