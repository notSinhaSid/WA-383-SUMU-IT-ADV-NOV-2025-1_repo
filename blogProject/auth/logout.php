<?php
session_start();
// for admin to logout
if(isset($_SESSION['admin'])) {
    session_destroy();
    header('Location: ../admin/index.php');
    exit();
}

// for user to logout
if(isset($_SESSION['user'])) {
    setcookie('rememberedEmail', '', time() - 3600);
    session_destroy();
    header('Location: ../auth/login.php');
    exit();
}
// for no session active
header('Location: ../auth/login.php');
exit();
?>