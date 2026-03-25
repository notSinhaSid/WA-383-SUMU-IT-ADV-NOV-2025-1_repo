<?php
require_once('../config/dbConfigClass.php');
require_once('classes/requesterClass.php');

$dbObject = new Database();
$dbResponse = $dbObject->dbConnectionGenerator();

$userObject = new User($dbResponse);

// deletion of user
if (!isset($_GET['uId'])) {
    header("Location: ../index.php");
    // echo "Cannot delete invalid user ❌";
    exit;
} else {
    $uId = intval($_GET['uId']);
    $currUser = $userObject->getCurrUser($uId);
    if (!$currUser) {
        header("Location: ../index.php");
        exit;
    }
    $uProfile = $currUser['uProfile'];

    if ($uProfile && file_exists(__DIR__ . "/../images/$uProfile")) {
        unlink(__DIR__ . "/../images/$uProfile");
    }

    if ($userObject->deleteUser($uId)) {
        header("Location: ../index.php");
        // echo "User deleted successfully ✔";
        exit;
    } else {
        echo '<script>window.alert("Failed to delete the requested user ❌")</script>';
    }
}