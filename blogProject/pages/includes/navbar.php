<?php session_start(); ?>
<nav class="navbar navbar-expand-lg px-4 py-2 border-bottom bg-white shadow-sm">

    <a href="../pages/index.php" class="navbar-brand fw-bold fs-5 text-dark text-decoration-none">BlogPost</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">

        <!-- Nav Links -->
        <ul class="navbar-nav me-auto ms-4 gap-1">
            <li class="nav-item">
                <a href="../pages/index.php" class="nav-link fw-medium text-dark <?php echo isset($navPage) && $navPage == 'home' ? 'active' : ''; ?>">Home</a>
            </li>
            <li class="nav-item">
                <a href="../pages/browsePost.php" class="nav-link fw-medium text-dark <?php echo isset($navPage) && $navPage == 'browse' ? 'active' : ''; ?>">Browse Posts</a>
            </li>
        </ul>

        <!-- Search Bar -->
        <?php if (isset($navPage) && $navPage == 'browse'): ?>
            <form class="d-flex me-3" method="GET" action="browsePost.php">
                <input type="text" name="search" class="form-control form-control-sm"
                    placeholder="Search posts..." style="width:220px;"
                    value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                <button class="btn btn-outline-secondary btn-sm ms-2" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </form>
        <?php endif; ?>

        <!-- Right Side -->
        <div class="d-flex align-items-center gap-2">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="../users/dashboard.php" class="btn btn-outline-primary btn-sm">Dashboard</a>
                <a href="../auth/logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
            <?php else: ?>
                <a href="../auth/login.php" class="btn btn-outline-primary btn-sm">Sign In</a>
                <a href="../auth/register.php" class="btn btn-primary btn-sm">Register</a>
            <?php endif; ?>
        </div>

    </div>
</nav>