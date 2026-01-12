<?php

$employees = [
    ['name' => 'Raj', 'dept' => 'IT'],
    ['name' => 'Simran', 'dept' => 'HR'],
    ['name' => 'Aman', 'dept' => 'IT'],
    ['name' => 'Neha', 'dept' => 'HR'],
    ['name' => 'Kunal', 'dept' => 'Finance'],
];

/*
        Tasks:
        Group employees by dept and Output department-wise employee names
        
        Expected Output:
        
        IT:
        - Raj
        - Aman
        
        HR:
        - Simran
        - Neha
        
        Finance:
        - Kunal 
 */

$deptWiseEmployee = [];
foreach($employees as $emgployeeDetails) {
    $department = $emgployeeDetails['dept'];
    $name = $emgployeeDetails['name'];

    // Here check if the name is there as the key in the $deptWiseEmployee blank array if not create one

    if(!isset($deptWiseEmployee[$department])) {
        $deptWiseEmployee[$department] =[];
    }

    $deptWiseEmployee[$department][] = $name;

}

foreach($deptWiseEmployee as $dept => $names) {
    echo "&nbsp;$dept: <br>";
    foreach($names as $name) {
        echo "&nbsp;&nbsp;-$name <br>";
    }
    echo "\n";
}