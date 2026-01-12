<?php
session_start();

$_SESSION['userName'] = "Siddhartha";
$_SESSION['userAge'] = 29;

print_r($_SESSION);

echo "<br>";
// session_unset();
// session_destroy();

print_r($_SESSION);