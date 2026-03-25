<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/assets/css/auth.register.css">
</head>

<body>

    <div class="register-wrapper">

        <!-- Left Panel -->
        <div class="register-left">
            <div class="brand">BlogPost</div>
            <h2>Join us today!</h2>
            <p>Create an account and start sharing your stories with the world.</p>

            <div class="left-features">
                <div class="left-feature-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                    </svg>
                    Write and publish posts
                </div>
                <div class="left-feature-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                    Join a growing community
                </div>
                <div class="left-feature-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                    </svg>
                    Organize with tags and categories
                </div>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="register-right">
            <div class="register-box">
                <h4 class="fw-bold mb-1">Create Account</h4>
                <p class="text-muted mb-4" style="font-size:14px;">Fill in the details to get started</p>

                <form id="registerForm" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="create">

                    <!-- Username -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Username</label>
                        <input type="text" name="uName" class="form-control" placeholder="Enter your username">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Email</label>
                        <input type="email" name="uEmail" class="form-control" placeholder="Enter your email">
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Gender</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input type="radio" name="uGender" value="male" class="form-check-input" id="male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="uGender" value="female" class="form-check-input" id="female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="uGender" value="other" class="form-check-input" id="other">
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Password</label>
                        <div class="position-relative">
                            <input type="password" name="uPassword" id="uPassword" class="form-control" placeholder="Enter password">
                            <span class="password-toggle" id="togglePassword">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.641 0-8.574-3.007-9.964-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Confirm Password</label>
                        <div class="position-relative">
                            <input type="password" name="uConfPassword" id="uConfPassword" class="form-control" placeholder="Confirm password">
                            <span class="password-toggle" id="toggleConfPassword">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.641 0-8.574-3.007-9.964-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Profile Picture -->
                    <div class="mb-4">
                        <label class="form-label fw-medium">Profile Picture <span style="font-size:12px; opacity:0.7;">(optional)</span></label>
                        <input type="file" name="uProfile" class="form-control" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-medium">Create Account</button>

                    <div id="formMessage" class="mt-3 text-center"></div>

                    <p class="text-center mt-3 mb-0" style="font-size:14px;">
                        Already have an account? <a href="login.php" class="fw-medium">Sign In</a>
                    </p>
                </form>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-4.0.0.js"></script>
    <script src="../public/assets/js/auth.Register.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const input = document.getElementById('uPassword');
            input.type = input.type === 'password' ? 'text' : 'password';
        });
        document.getElementById('toggleConfPassword').addEventListener('click', function() {
            const input = document.getElementById('uConfPassword');
            input.type = input.type === 'password' ? 'text' : 'password';
        });
    </script>
</body>

</html>