<?php
// MODULE - 3 SECTION 3

/**
 * prediction of output
 */

// $x = 4;
// $y = 2;
// echo $x**$y;
// echo "\n";
// $a = 10;
// $b = $a + $a++;
// echo $b;

// echo "\n";

$i = 1;
while($i <= 3) {
    echo $i . "\t";
    $i++;
}


echo "\n";

$x = 1;
do {
    echo $x. "\t";
    $x++;

}while($x < 4);

echo "\n";
$nums = [1, 2, 3];
foreach($nums as $num) {
    if($num == 2){
        continue;
    }
    echo $num . "\t";
}