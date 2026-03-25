<?php
// role based checking = > 
function checkRole($role)
{
    if (!isset($_SESSION[$role])) {
        if ($role === 'admin') {
            header('Location: ../admin/index.php');
        } else {
            header('Location: ../auth/login.php');
        }
        exit();
    }
}