<?php
require_once(__DIR__ .'/../config/Database.php');
require_once(__DIR__ . '/../classes/User.php');
session_start();

$dbObj = new Database();
$conn = $dbObj->getConnection();
$userObj = new User($conn);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    switch($action){

    // OTP - creation random 5-7 digit code , send to email
    // Require OTP for first time
    // verify column with YES/NO in the table - > default = NO {enum =>}
    /*
        before register is complete - show a POP UP to provide OTP
        hold the data in session variable
        when the otp is provided , verify the otp
        if OTP === true/correct
            redirect -> login page


            BASE64 -> encode/decode
     */
        case 'create' :
            $uName = $_POST['uName'];
            $uEmail = $_POST['uEmail'];
            $uGender = $_POST['uGender'];
            $uPassword = $_POST['uPassword'];
            $uConfPassword = $_POST['uConfPassword'];
            $uProfile = '';

            if(empty($uName)||empty($uEmail)||empty($uGender)||empty($uPassword)||empty($uConfPassword)){
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Fill All Fields',
                ]);
                exit();
            }

            $checkUserExists = $userObj->getUserByEmail($uEmail);
            if($checkUserExists){
                ob_clean();
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Email already exists, Please Login or try different email 👌',
                    'redirect' => 'register.php',
                ]);
                exit();
            }

            // check for password and confirm password
            if($uPassword != $uConfPassword){
                echo json_encode([
                    'status' => 'error',
                    'message' => 'passwords are not same',
                ]);
                exit();
            }

            if(isset($_FILES['uProfile']) && $_FILES['uProfile']['error'] === 0) {
                $allowedExtension = ['jpeg', 'jpg', 'png'];
                $maxSize = 3*1024*1024; // 3MB size

                $extension = strtolower(pathinfo($_FILES['uProfile']['name'], PATHINFO_EXTENSION));
                $mime = mime_content_type($_FILES['uProfile']['tmp_name']);

                if(!in_array($mime, ['image/jpeg', 'image/jpg', 'image/png']) && !in_array($extension, $allowedExtension)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wrong File Formate',
                    ]);
                    exit();
                }

                if($_FILES['uProfile']['size'] > $maxSize) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'File Size too big',
                    ]);
                    exit();
                }

                // generate secure name
                $uProfile = bin2hex(random_bytes(16)) . '.' . $extension;
                $filePath = __DIR__ . '/../public/assets/uploads/' . $uProfile;

                if(!move_uploaded_file($_FILES['uProfile']['tmp_name'], $filePath)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Something went wrong',
                    ]);
                    exit();
                }

            }
            /* else{
                if($uGender === 'male'){
                    $uProfile = 'maleDefault.jpg';
                }else if($uGender === 'female') {
                    $uProfile = 'femaleDefault.jpg';
                }
                else{
                    $uProfile = 'default.jpg';
                }
            } */

            $uPassword = password_hash($uPassword, PASSWORD_BCRYPT);

            $result = $userObj->create($uName, $uEmail, $uGender, $uPassword, $uProfile);
            if($result) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'You are now registered',
                ]);
            }
            else{
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Something went wrong, Try again',
                ]);
            }

            break;

        /*
        when the user click on login, fetch the user using email provided
        if the email exsits , check/verify the password which is hashed
        if all satisfy, then send to dashboard page 

        -> enter OTP for first time login process

        if Verfiy === YES
            no more OTP from then on

            LOGIN PAGE ---- ALERT ------ CHECKING
        */
        case 'login':
            $uEmail = $_POST['uEmail'];
            $uPassword = $_POST['uPassword'];

            if(empty($uEmail) || empty($uPassword)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Credentials Required',
                ]);
                exit();
            }

            $userByEmail = $userObj->getUserByEmail($uEmail);
            if(!$userByEmail) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Email not found',
                ]);
                exit();
            }

            if(!password_verify($uPassword, $userByEmail['uPassword'])) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Wrong Password',
                ]);
                exit();
            }

            // check for remember me using cookies
            if(isset($_POST['rememberMe']) ?? false) {
                setcookie('rememberedEmail', $uEmail, time() + (1*24*60*60), '/');
            }

            $_SESSION['user']['uId'] = $userByEmail['uId'];
            $_SESSION['user']['uName'] = $userByEmail['uName'];
            $_SESSION['user']['uEmail'] = $userByEmail['uEmail'];
            $_SESSION['user']['uRole'] = $userByEmail['uRole'];
            $_SESSION['user']['uProfile'] = $userByEmail['uProfile'];
            $_SESSION['user']['uGender'] = $userByEmail['uGender'];

            $redirectRoute = ($userByEmail['uRole'] === 'admin') ? '../admin/dashboard.php' : '../users/dashboard.php';

            echo json_encode([
                'status' => 'success',
                'message' => 'Welcome back,' . $userByEmail['uName'],
                'redirect' => $redirectRoute,
            ]);
            exit();
            break;
// ADMIN LOGIN SECTION STARTS HERE --------------------------------------------------------------------------
        case 'adminLogin':
            $uEmail = $_POST['uEmail'];
            $uPassword = $_POST['uPassword'];
            if (empty($uEmail) || empty($uPassword)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Credentials Required',
                ]);
                exit();
            }
            $userByEmail = $userObj->getUserByEmail($uEmail);
            if(!$userByEmail) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Requested Admin Email not available',
                ]);
                exit();
            }

            $uRoleCheck = $userByEmail['uRole'];
            if($uRoleCheck != 'admin'){
                echo json_encode([
                    'status' => 'error',
                    'message' => 'You are not premitted to visit this link!',

                ]);
                exit();
            }

            if (!password_verify($uPassword, $userByEmail['uPassword'])) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Wrong Password',
                ]);
                exit();
            }

            $_SESSION['admin']['uId'] = $userByEmail['uId'];
            $_SESSION['admin']['uName'] = $userByEmail['uName'];
            $_SESSION['admin']['uEmail'] = $userByEmail['uEmail'];
            $_SESSION['admin']['uRole'] = $userByEmail['uRole'];

            $redirectRoute = '../admin/dashboard.php';

            echo json_encode([
                'status' => 'success',
                'message' => 'Welcome back,' . $userByEmail['uName'],
                'redirect' => $redirectRoute,
            ]);
            
    }
}