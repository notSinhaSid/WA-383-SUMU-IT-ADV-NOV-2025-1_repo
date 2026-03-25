<?php
session_start();
require '../includes/functions.php';
checkRole('admin');
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../classes/Post.php');
require_once(__DIR__ . '/../classes/Category.php');
require_once(__DIR__ . '/../classes/Tag.php');
require_once(__DIR__ . '/../classes/User.php');

$dbObj = new Database();
$conn = $dbObj->getConnection();

$postObj = new Post($conn);
$userObj = new User($conn);
$tagObj = new Tag($conn);
$categoryObj = new Category($conn);

$postCount = $postObj->postCount();
$userCount = $userObj->getTotalUserCount();
$tagCount = $tagObj->getTotalTagCount();
$categoryCount = $categoryObj->getCategoryCount();

$currentPage = 'dashboard';
$pageTitle   = 'Dashboard';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/dashboard.css">
</head>

<body>

    <div class="d-flex main-wrapper">

        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Right Side -->
        <div class="flex-grow-1 d-flex flex-column main-content">

            <!-- Topbar -->
            <?php include 'includes/topbar.php'; ?>

            <!-- Main Content -->
            <div class="p-4 flex-grow-1">

                <div class="row g-4">

                    <!-- Total Posts -->
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color:#1d4ed820;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#3b82f6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                                </svg>
                            </div>
                            <small>Total Posts</small>
                            <h3><?php echo $postCount; ?></h3>
                        </div>
                    </div>

                    <!-- Total Users -->
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color:#14532d20;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#22c55e">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                            </div>
                            <small>Total Users</small>
                            <h3><?php echo $userCount; ?></h3>
                        </div>
                    </div>

                    <!-- Total Comments -->
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color:#7c2d1220;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#f97316">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                </svg>
                            </div>
                            <small>Total Comments</small>
                            <h3>0</h3>
                        </div>
                    </div>

                    <!-- Total Tags -->
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color:#4c1d9520;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#a855f7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                </svg>
                            </div>
                            <small>Total Tags</small>
                            <h3><?php echo $tagCount; ?></h3>
                        </div>
                    </div>

                    <!-- Total Categories -->
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color:#4c1d9520;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-check" viewBox="0 0 16 16" stroke-width="1.3" stroke="#83f0f0">
                                    <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z" />
                                    <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z" />
                                    <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                </svg>
                            </div>
                            <small>Total Categories</small>
                            <h3><?php echo $categoryCount; ?></h3>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>