<?php

$marks = 48;

echo "Your marks is $marks and your Final result is : ";

switch($marks) {
    case ($marks > 80 && $marks <= 100):
        echo "Distiction";
        break;
    case ($marks >=60  && $marks < 80):
        echo "1st Division";
        break;
    case ($marks >= 45 && $marks < 60): 
        echo "2nd Division";
        break;
    case ($marks >= 35 && $marks < 45):
        echo "3rd Division";
        break;
    case ($marks < 35):
        echo "Failed";
        break;
    default:
        echo "Invalid marks provided! Try again";
    
}