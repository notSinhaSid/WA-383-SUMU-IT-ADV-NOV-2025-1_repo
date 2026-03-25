<?php
session_start();
require '../includes/functions.php';
checkRole('admin');
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../classes/Category.php');

$dbObj   = new Database();
$conn    = $dbObj->getConnection();
$catObj  = new Category($conn);

$rowPerTable = 5;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $rowPerTable;

$startIndex = $offset +1;


$totalCat = $catObj->getCategoryCount();
$totalRows = ceil($totalCat / $rowPerTable);
$categoryVar = $catObj->getCategoryForPagination($rowPerTable, $offset);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/category.css">
</head>

<body>

    <div class="d-flex main-wrapper">

        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-grow-1 d-flex flex-column main-content">

            <?php include 'includes/topbar.php'; ?>

            <!-- Main Content -->
            <div class="p-4">

                <!-- Page Header -->
                <div class="page-header">
                    <h4>Manage Categories</h4>
                    <p>Add and manage post categories</p>
                </div>

                <div class="row g-4">

                    <!-- Add Category Form -->
                    <div class="col-md-4">
                        <div class="admin-card">
                            <h6>Add New Category</h6>
                            <form id="addCategoryForm">
                                <input type="hidden" name="action" value="createCategory">
                                <div class="mb-3">
                                    <label class="form-label">Category Name</label>
                                    <input type="text" name="catName" id="catName"
                                        class="form-control" placeholder="e.g. Technology">
                                </div>
                                <button type="submit" class="btn-admin-primary w-100">
                                    Add Category
                                </button>
                                <div id="formMessage"></div>
                            </form>
                        </div>
                    </div>

                    <!-- Categories Table -->
                    <div class="col-md-8">
                        <div class="admin-card">
                            <h6>All Categories</h6>

                            <?php if (!empty($categoryVar)): ?>
                                <table class="category-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category Name</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody id="categoryTableBody">
                                        <?php foreach ($categoryVar as $index => $cat): ?>
                                            <tr>
                                                <td><?php echo $startIndex; ?></td>
                                                <td>
                                                    <span class="badge-category">
                                                        <?php echo htmlspecialchars($cat['catName']); ?>
                                                    </span>
                                                </td>
                                                <td><?php echo date('jS M, Y', strtotime($cat['created_at'])); ?></td>
                                            </tr>
                                        <?php
                                            $startIndex++; 
                                            endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="empty-state">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="#475569">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                    </svg>
                                    <p>No categories yet. Add your first one!</p>
                                </div>
                            <?php endif; ?>

                            <!-- pagination for table  -->
                            <?php if ($totalCat > 1): ?>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end pagination-sm">
                                        <li class="page-item <?php echo $currentPage == 1 ? 'disabled' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                                </svg>
                                            </a>
                                        </li>
                                        <?php for ($i = 1; $i <= $totalRows; $i++): ?>
                                            <li class="page-item <?php echo $currentPage == $i ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <li class="page-item <?php echo $currentPage == $totalRows ? 'disabled' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-4.0.0.js"></script>
    <script src="../public/assets/js/admin.category.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>