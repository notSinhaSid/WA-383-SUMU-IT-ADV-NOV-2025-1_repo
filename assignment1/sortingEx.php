<?php

function sortArray($arr) {
    echo "The unsorted array : ";
    for ($i = 0; $i < count($arr); $i++) {
        echo "$arr[$i]" . "\n";
    }

    echo "<br>";

    echo "The sorted array : ";
    for($i = 0; $i < count($arr); $i++) {
        $tempArrEl = 0;
        for($j = $i+1; $j < count($arr); $j++) {
            if($arr[$i] > $arr[$j]) {
                $tempArrEl = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $tempArrEl;
            }
        }
    }

    for($i = 0; $i < count($arr); $i++){
        echo "$arr[$i]". "\n";
    }
}

$unSortedArray = array(1, 3, 4, 3, 7, 9, 3, 5);

sortArray($unSortedArray);