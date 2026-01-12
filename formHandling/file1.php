<?php

session_start();

$_SESSION['userName'] = "Siddhartha";

echo "<pre>";
print_r($_SESSION);
echo "</pre>";