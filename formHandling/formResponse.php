<?php
session_start();

// token in session => rand value
// session id => value in hidden field

if($_SERVER['REQUEST_METHOD']=== 'POST' && isset($_REQUEST['register'])) {

    if(isset($_SESSION['id'])){
        /* $currentSessionId = $_SESSION['id'];
        echo "Current Session id : $currentSessionId <br>";
        echo $_REQUEST['id']."<br>"; */

        if (($_REQUEST['name'] == "") || ($_REQUEST['age'] == "") || ($_REQUEST['email'] == "") || ($_REQUEST['phnNumber'] == "")||(empty($_REQUEST['id']))) {
            echo "<strong>Please fill all fields</strong>";
        } 
        else {
            $name = $_REQUEST['name'];
            $age = $_REQUEST['age'];
            $email = $_REQUEST['email'];
            $phnNumber = $_REQUEST['phnNumber'];
            $id = $_REQUEST['id'];

            /* var_dump($_REQUEST['id']);
            var_dump($currentSessionId); */

            // $currentSessionId = rand(99999);
            if($id == $_SESSION['id']) {
                echo <<<EOD
                Welcome $name ,<br>
                Your age is $age ,<br>
                You have register with email id : $email    <br>
                Your prefered mobile number is : $phnNumber <br>
                EOD;

                $_SESSION['id'] = rand(11111, 99999);
                echo $_SESSION['id'];
            }
            else {
                echo "\n Invalid SESSION , TRY AGAIN !! <br>";
            } 
        }
    }

    else {
        echo "\nNO CURRENT SESSION IN USE <br>";
    }
    
    
}
    


?>