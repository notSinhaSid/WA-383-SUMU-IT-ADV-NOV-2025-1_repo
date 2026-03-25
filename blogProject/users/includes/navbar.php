<?php
$profile = $_SESSION['user']['uProfile'];
$gender = $_SESSION['user']['uGender'];
?>

<nav class="navbar navbar-expand-lg px-4 py-2 border-bottom bg-white shadow-sm">

    <!-- Logo -->
    <a href="../pages/index.php" class="navbar-brand fw-bold fs-5 text-dark text-decoration-none">
        BlogPost
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">

        <!-- Nav Links -->
        <ul class="navbar-nav me-auto ms-4 gap-1">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link fw-medium text-dark d-flex align-items-center gap-1 <?php echo isset($navPage) && $navPage == 'dashboard' ? 'active' : ''; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="createPost.php" class="nav-link fw-medium text-dark d-flex align-items-center gap-1 <?php echo isset($navPage) && $navPage == 'create_post' ? 'active' : ''; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create Post
                </a>
            </li>
            <li class="nav-item">
                <a href="../pages/index.php" class="nav-link fw-medium text-dark d-flex align-items-center gap-1 <?php echo isset($navPage) && $navPage == 'browse' ? 'active' : ''; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>
                    Browse Posts
                </a>
            </li>
        </ul>

        <?php include(__DIR__ . '/../includes/searchBar.php'); ?>

        <!-- Right Side -->
        <div class="d-flex align-items-center gap-3">

            <!-- Show only on create post page -->
            <?php if (isset($navPage) && $navPage == 'create_post'): ?>
                <button type="button" class="btn-draft">Save Draft</button>
                <button class="btn-publish" id="publishBtn">Publish Post</button>
            <?php endif; ?>
            <?php if (isset($navPage) && $navPage == 'edit_post'): ?>
                <button type="submit" form="createPostForm" id="updateBtn" class="btn-publish">Update Post</button>
            <?php endif; ?>

            <!-- Notifications -->
            <button class="btn btn-light btn-sm rounded-circle p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
            </button>

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <button class="btn p-0 border-0 d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                    <img src="<?php echo $siteURL; ?>/public/assets/uploads/<?php
                                                            if (!empty($profile)) {
                                                                echo 'profile/' . $profile;
                                                            } else {
                                                                if ($gender === 'male') {
                                                                    echo 'maleDefault.jpg';
                                                                } else if ($gender === 'female') {
                                                                    echo 'femaleDefault.jpg';
                                                                } else {
                                                                    echo 'default.jpg';
                                                                }
                                                            }
                                                            ?>" alt="profile picture of <?php echo $_SESSION['user']['uName']; ?>" style="width:36px; height:36px ;">
                    <span class="fw-semibold text-dark" style="font-size:14px;">
                        <?php echo $_SESSION['user']['uName']; ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="profile.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            Profile
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 text-danger" href="../auth/logout.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                            </svg>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</nav>