<?php

function fibonacciSeries($range) {
    $ini1 = 0;
    $ini2 = 1;

    if($range <= 1) {
        echo $ini1. "\t".$ini2;
    }
    else {
        echo $ini1 . "\t" . $ini2."\t";
        for($i = 2; $i<= $range; $i++) {
            $temp = $ini1 + $ini2;
            echo $temp. "\t";

            $ini1 = $ini2;
            $ini2 = $temp;
        }
    }

}

$range = 4;
fibonacciSeries(4);

