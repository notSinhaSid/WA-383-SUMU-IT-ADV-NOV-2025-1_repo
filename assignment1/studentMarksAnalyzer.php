<?php

$students = [
    ['name'=> 'Amit', "marks" =>[70, 80, 90]],
    ['name'=> 'Riya', "marks" =>[60, 75, 85]],
    ['name'=> 'John', "marks" =>[90, 88, 92]],
];

$topperName = ""; $topperMarksAvg = 0;


foreach($students as $student) {
    $totalMarks = array_sum($student['marks']);

    $average = $totalMarks / count($student['marks']);

    if($average > $topperMarksAvg) {
        $topperMarksAvg = $average;
        $topperName = $student['name'];
    }

    echo $student['name']. "  => Total : ". $totalMarks . " Average : " . $average. " <br>";

    echo "\n";


}

echo "Topper : $topperName";
