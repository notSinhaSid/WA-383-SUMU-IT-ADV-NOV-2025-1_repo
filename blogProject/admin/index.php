<?php
session_start();

if (isset($_SESSION['admin'])) {
    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>

    <div class="login-card">

        <div class="lock-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#dc2626">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
        </div>

        <h4 class="text-center mb-1">Admin Panel</h4>
        <p class="text-center mb-4">Restricted Access Only</p>

        <form id="adminLoginForm">
            <input type="hidden" name="action" value="adminLogin">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="uEmail" class="form-control" placeholder="Enter admin email">
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="uPassword" class="form-control" placeholder="Enter password">
            </div>

            <button type="submit" class="btn-login">Login</button>

            <div id="formMessage" class="mt-3 text-center" style="font-size: 0.875rem;"></div>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-4.0.0.js"></script>
    <script src="../public/assets/js/admin.Login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>