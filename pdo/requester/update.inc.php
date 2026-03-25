<?php
/* require_once('../config/dbConfigClass.php');
require_once('classes/requesterClass.php');

$dbObject = new Database();
$dbResponse = $dbObject->dbConnectionGenerator();

$userObject = new User($dbResponse); */

// update of user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uUpdate'])) {
    if (($_POST['uName'] == "") || ($_POST['uEmail'] == "") || ($_POST['uPhone'] == "")) {
        echo "Fill all fields";
    } else {
        $uId = intval($_POST['uId']);
        $uName = trim($_POST['uName']);
        $uEmail = trim($_POST['uEmail']);
        $uPhone = trim($_POST['uPhone']);
        
        // Get the current user data
        $currUser = $userObject->getCurrUser($uId);
        $uProfile = $currUser['uProfile'];

        // Check if a new file is uploaded
        if (!empty($_FILES['uProfile']['name'])) {
            // Delete old profile image if it exists
            if ($uProfile && file_exists(__DIR__ . "/../images/$uProfile")) {
                unlink(__DIR__ . "/../images/$uProfile");
            }

            $targetDir = "images/";
            $uProfile = time() . '_' . trim(basename($_FILES['uProfile']['name']));
            move_uploaded_file($_FILES['uProfile']['tmp_name'], $targetDir . $uProfile);
        }

        if ($userObject->updateUser($uId, $uName, $uEmail, $uPhone, $uProfile)) {
            header("Location: index.php");
            exit;
        } else {
            echo '<script>window.alert("Failed to update user")</script>';
        }
    }
}
