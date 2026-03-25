<?php
if(isset($_COOKIE['rememberedEmail'])){
    $uEmail = $_COOKIE['rememberedEmail'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/assets/css/auth.login.css">
</head>

<body>

    <div class="login-wrapper">

        <!-- Left Panel -->
        <div class="login-left">
            <div class="brand">BlogPost</div>
            <h2>Welcome back!</h2>
            <p>Share your thoughts, ideas and stories with the world.</p>
        </div>

        <!-- Right Panel -->
        <div class="login-right">
            <div class="login-box">
                <h4 class="fw-bold mb-1">Sign in</h4>
                <p class="text-muted mb-4" style="font-size:14px;">Enter your credentials to continue</p>

                <form id="loginForm">
                    <input type="hidden" name="action" value="login">

                    <div class="mb-3">
                        <label class="form-label fw-medium">Email</label>
                        <input type="email" name="uEmail" class="form-control" placeholder="Enter your email" value="<?php if(isset($uEmail)){echo $uEmail;}else{echo "";}?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium">Password</label>
                        <div class="position-relative">
                            <input type="password" name="uPassword" id="uPassword" class="form-control" placeholder="Enter your password">
                            <span class="password-toggle" id="togglePassword">
                                <!-- Eye Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.641 0-8.574-3.007-9.964-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="rememberMe" class="form-check-input" id="rememberMe">
                        <label class="form-check-label text-white" for="rememberMe">Remember me</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-medium">Sign in</button>

                    <div id="formMessage" class="mt-3 text-center"></div>

                    <p class="text-center mt-4 mb-0" style="font-size:14px;">
                        Don't have an account? <a href="register.php" class="fw-medium">Register</a>
                    </p>
                </form>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-4.0.0.js"></script>
    <script src="../public/assets/js/auth.Login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // password toggle
        document.getElementById('togglePassword').addEventListener('click', function() {
            const input = document.getElementById('uPassword');
            input.type = input.type === 'password' ? 'text' : 'password';
        });
    </script>
</body>

</html>