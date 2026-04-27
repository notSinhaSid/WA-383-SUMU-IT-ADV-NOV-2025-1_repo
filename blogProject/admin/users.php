<?php
session_start();
require '../includes/functions.php';
checkRole('admin');
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../classes/User.php');

$dbObj   = new Database();
$conn    = $dbObj->getConnection();
$userObj = new User($conn);
$getUser = $userObj->getAllUser();

$currentPage = 'users';
$pageTitle   = 'Manage Users';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/users.css">
</head>

<body>

    <div class="d-flex main-wrapper">

        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-grow-1 d-flex flex-column main-content">

            <?php include 'includes/topbar.php'; ?>

            <div class="p-4">

                <!-- Page Header -->
                <div class="page-header">
                    <h4>Manage Users</h4>
                    <p>View and manage all registered users</p>
                </div>

                <!-- Users Table Card -->
                <div class="admin-card">

                    <?php if (!empty($getUser)): ?>
                        <table class="users-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getUser as $index => $user): ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td>
                                            <div class="user-info">
                                                <div class="user-avatar">
                                                    <?php echo strtoupper(substr($user['uName'], 0, 1)); ?>
                                                </div>
                                                <?php echo htmlspecialchars($user['uName']); ?>
                                            </div>
                                        </td>
                                        <td><?php echo htmlspecialchars($user['uEmail']); ?></td>
                                        <td>
                                            <span class="badge-active">
                                                <?php echo ucfirst($user['uRole']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="<?php echo isset($user['isActive']) && $user['isActive'] === 'no' ? 'badge-inactive' : 'badge-active'; ?>">
                                                <?php echo isset($user['isActive']) && $user['isActive'] === 'no' ? 'Inactive' : 'Active'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn-deactivate deactivate-btn" data-id="<?php echo $user['uId']; ?>">Deactivate</a>
                                            <a href="#" class="btn-activate activate-btn" data-id="<?php echo $user['uId']; ?>">Activate</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <div class="empty-state">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="#475569">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                            <p>No users found</p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <!-- Toast -->
            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:9999;">
                <div id="userToast" class="toast text-bg-success border-0" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">Action completed!</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-4.0.0.js"></script>
    <script src="../public/assets/js/admin.manageUsers.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>