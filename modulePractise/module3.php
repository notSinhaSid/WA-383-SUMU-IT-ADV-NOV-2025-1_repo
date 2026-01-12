<?php

/* 

1. Which of the following is the correct way to start a PHP block? 

a) <php> 

b) <?php ?> 

c) <? ?> 

d) Both (b) and (c) 

 
2. Which of the following is NOT a valid variable name in PHP? 

a) $name 

b) $_123value 

c) $first-name 

d) $value_1 


3. What will be the output of this code? 

$x = 5; 

$y = '5'; 

echo $x == $y; 

a) 0 

b) 1 

c) Error 

d) None 
 

4. Which of the following data types is not supported in PHP? 

a) Integer 

b) String 

c) Character 

d) Boolean 

 
5. How do you add a single-line comment in PHP? 

a) # comment 

b) // comment 

c) /* comment */ 

/* d) Both (a) and (b) 

 
6. Which function returns the data type of a variable? 

a) datatype() 

b) gettype() 

c) typeof() 

d) var_type() 

 
7. What is the output of this code? 

$x = 5; 

$y = 10; 

echo $x + $y . 'test'; 

a) 15test 

b) 510test 

c) Error 

d) test15 

 
8. Which of the following represents a float in PHP? 

a) 5.2 

b) 2 

c) '5' 

d) '5.0' 

 

9. Which symbol is used to concatenate strings in PHP? 

a) + 

b) & 

c) . 

d) , 

 

10. What will be the value of $a after executing this code? 

$a = 5; 

$a += 10; 

a) 5 

b) 10 

c) 15 

d) 50 



Section B – True or False (1 mark each) 

 

11. PHP variable names are case sensitive. 

12. PHP automatically converts variable types based on their value. 

13. In PHP, all variables must be declared before use. 

14. The data type of null represents a variable with no value. 

15. Variables declared inside a function are globally accessible by default. 

 

Section C – Output Prediction (2 marks each) 


16. What will be the output? 

$x = 10; 

$y = '10'; 

echo $x === $y ? 'Equal' : 'Not Equal'; 



17. Predict the result: 

$a = 'Hello'; 

$b = 'World'; 

echo $a . ' ' . $b; 


18. What is the output? 

$num = 10; 

$num = $num + 5; 

echo $num; 

 
19. What will this display? 

$var = null; 

echo gettype($var); 

 
20. What will the output be? 

$x = 10; 

$y = 3; 

echo $x % $y; 


Section D – Short Answer (2 marks each) 

 
21. Explain the difference between == and === operators in PHP. 

22. List any four PHP data types with one example each. 

23. What is type juggling in PHP? 

24. What is the difference between a variable and a constant in PHP? 

25. What does the var_dump() function do? 

 
*/ 

// ANSWERS
echo "------------ SECTION A -------------- \n";
echo "1) <?php ?> \n";
echo '2) $first-name'."\n";
echo '3) 1'."\n";
echo '4) Character'."\n";
echo '5) // comment'."\n";
echo '6) gettype()'."\n";
echo '7) 15test'."\n";
echo '8) 5.2'."\n";
echo '9) .'."\n";
echo '10) 15'."\n";
echo "-------------- SECTION B --------------- \n";
echo '11) TRUE' . "\n";
echo '12) TRUE' . "\n";
echo '13) FALSE' . "\n";
echo '14) TRUE' . "\n";
echo '15) FALSE' . "\n";
echo "---------------- SECTION C -------------- \n";
echo '16) Not Equal' . "\n";
echo '17) Hello World' . "\n";
echo '18) 15' . "\n";
echo '19) NULL' . "\n";
echo '20) 1' . "\n";
echo "---------------- SECTION D -------------- \n";
echo <<<EOD
    21) The difference between == and === is that === is strict comparison where the type is strictly checked
    there is no type conversion , to match the types.
    EOD;

    echo <<<EOD
    22) [1 String datatype] => "this is string" and so is this 'string'
        [2 Integer datatype] => any numeric values without decimal is INTEGER
        [3 Float datatype] => decimal values 
        [4 Boolean datatype] => TRUE OR FALSE values
    EOD;

echo <<<EOD
    23) Type Juggling is the automatic type conversion done the PHP at the runtime to convert the data type of any 
    value as per need of the opertaion.
    EOD;

echo <<<EOD
    24) The difference between variable and constant in php:-
            a. values stored in variable are mutable while not so in constants
            b. variables are declared using $ symbol
            c. constant are declared using either CONST keyword of DEFINE() keyword with name and values of constant as parameter
    EOD;

echo <<<EOD
    25) var_dump() function dumps all the info about a variable to screen like the size and type along with the value.
    EOD;