<?php

$studentTableHeader = ['Name', 'Age', 'City', 'Marks'];
$student_array = array(
    array('Jonas', 18, 'New York', 78),
    array('Piyush', 19, 'Delhi', 68),
    array('Devansh', 18, 'Askhok Nagar', 52),
    array('Manav', 22, 'Mayur Vihar', 70)
);

echo "<pre>";
    print_r($student_array);
echo "</pre>";

$lengthOfArray = count($student_array);
$lengthOfHeaderArray = count($studentTableHeader);

/* 
ADD THE TABLE HEADING TO ARRAY
*/
echo "<table border = 1>";
echo "<tr>";
for($i = 0; $i < $lengthOfHeaderArray; $i++){
    echo "<th><h3>".$studentTableHeader[$i]."</h3></th>"; 
}
/* echo "<th><h3>Name</h3></th>";
echo "<th><h3>Age</h3></th>";
echo "<th><h3>Address</h3></th>";
echo "<th><h3>Marks</h3></th>"; */
echo "</tr>";

/* foreach($student_array as $student_array) {
    echo "<tr>";
        foreach($student_array as $studentData) {
            echo "<td>$studentData</td>";
        }
    echo "</tr>";
} */
echo "<tbody>";
for($i = 0; $i < $lengthOfArray; $i++) {
    echo "<tr>";
    for($j =0; $j < count($student_array[$i]); $j++) {
        echo "<td>". $student_array[$i][$j]."</td>";
    }
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";