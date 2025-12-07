<?php

/*  PATTERN -1
  */

echo "<h2>Pattern 1</h2>";
$rows = 5;
for($i = 1; $i<= $rows; $i++) {
    for($j= $i; $j<= $rows; $j++){
        echo $j;
    }
    echo "<br/>";
}


echo "<h2>Pattern 2</h2>";
//  PATTERN _2
for ($i = 1; $i <= $rows; $i++) {
    for ($j = $i; $j <= $rows; $j++) {
        echo $i;
    }
    echo "<br/>";
}

echo "<h2>Pattern 3</h2>";

for($i = 1; $i <= $rows; $i++){
    for($j = 1; $j<=$i; $j++){
        echo "$j";
    }
    echo "<br>";
}

echo "<h2>Pattern 4</h2>";

for ($i=1; $i <= $rows ; $i++) { 
    for($j = 1; $j<= $i; $j++) {
        echo "$i";
    }

    echo "<br>";
}

echo "<h2>Pattern 5</h2>";
$k = $rows;
for($i = 1; $i <= $rows; $i++) {
    for($j = 1; $j <= $i; $j++) {
        echo $k;
    }
    $k--;

    echo "<br>";
}

echo "<h2>Pattern 6</h2>";
for ($i = 1; $i <= $rows; $i++) {
    $k = $rows;
    for ($j = $i; $j <= $rows; $j++) {
        echo $k;
        $k--;
    }

    echo "<br/>";
}
