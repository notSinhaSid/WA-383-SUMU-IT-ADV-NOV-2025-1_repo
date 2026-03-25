<?php
/* require_once('config/dbConfigClass.php');
require_once('requester/classes/requesterClass.php');

$dbObject = new Database();
$dbResponse = $dbObject->dbConnectionGenerator();

$userObject = new User($dbResponse); */



// insertion of register user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uRegister'])) {
    if (($_POST['uName'] == "") || ($_POST['uEmail'] == "") || ($_POST['uPhone'] == "")) {
        echo "Fill all fields";
    } else {
        $uName = trim($_POST['uName']);
        $uEmail = trim($_POST['uEmail']);
        $uPhone = trim($_POST['uPhone']);
        $uProfile = '';

        if (!empty($_FILES['uProfile']['name'])) {
            $targetDir = "images/";
            $uProfile = time() . '_' . trim(basename($_FILES['uProfile']['name']));
            move_uploaded_file($_FILES['uProfile']['tmp_name'], $targetDir . $uProfile);
        }

        if ($userObject->createRegisterUser($uName, $uEmail, $uPhone, $uProfile)) {

            header("Location: index.php");
        } else {
            echo '<script>window.alert("Failed to register user")</script>';
        }
    }
}