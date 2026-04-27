<?php
session_start();
require '../includes/functions.php';
checkRole('admin');
/* echo '<pre>';
print_r($_SESSION);
echo '</pre>'; */
$currentPage = 'create';
$pageTitle   = 'Create Post';
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../classes/Post.php');
require_once(__DIR__ . '/../classes/Category.php');
$dbObj = new Database();
$conn = $dbObj->getConnection();

$postObj = new Post($conn);

$catObj = new Category($conn);
$getCategory = $catObj->getCategoryAll();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/create.css">
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
            <!-- Create Post Layout -->
            <form id="createPostForm" enctype="multipart/form-data">
                <input type="hidden" name="action" value="createPost">
                <!-- wrapper starts here for the form section -->
                <div class="create-post-wrapper">

                    <!-- Left Column -->
                    <div class="left-col">

                        <!-- Title -->
                        <div>
                            <label class="form-label">Post Title</label>
                            <input type="text" name="postTitle" id="postTitle" class="form-control" placeholder="Enter your post title...">
                        </div>

                        <!-- Cover Image -->
                        <div>
                            <label class="form-label">Cover Image</label>
                            <div class="cover-upload">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="#94a3b8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <p class="text-muted mt-2 mb-2" style="font-size:13px;">Click to upload cover image</p>
                                <input type="file" name="postCoverImage" id="postCoverImage" class="form-control" accept="image/*">
                                <small class="text-muted" style="font-size:11px;">JPG, PNG up to 3MB</small>
                            </div>
                        </div>
                        <!-- Category -->

                        <div>
                            <label class="form-label fw-semibold">Category</label>
                            <select name="postCategoryId" id="postCategoryId" class="form-select">
                                <option value="">Select Category</option>
                                <?php if (!empty($getCategory)): ?>
                                    <?php foreach ($getCategory as $catName): ?>
                                        <option value="<?php echo $catName['catId']; ?>"><?php echo $catName['catName']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <small class="text-muted" style="font-size:11px;">Select a category for your post</small>
                        </div>

                        <!-- Tags -->
                        <div>
                            <label class="form-label">Tags</label>
                            <input
                                type="text"
                                name="postTags"
                                id="postTags"
                                class="form-control"
                                placeholder="e.g. PHP, Laravel, Web Development">
                            <small class="text-muted" style="font-size:11px;">Separate tags with a comma</small>
                        </div>

                    </div>

                    <!-- Right Column — Content Editor -->
                    <div class="right-col">
                        <label class="form-label">Content</label>
                        <textarea
                            name="postContent"
                            id="postContent"
                            class="content-editor"
                            placeholder="Write your post content here..."></textarea>
                    </div>

                </div>
                <!-- wrapper ends here for the form section  -->
                <!-- here starts the button section for publishing the post -->
                <div class="d-flex justify-content-end gap-2 px-4 pb-4">
                    <div id="formMessage" class="me-auto"></div>
                    <button type="button" class="btn-draft">Save Draft</button>
                    <button type="button" id="publishBtn" class="btn-publish">Publish Post</button>
                </div>
                <!-- here ends the button for publish post -->
            </form>
            <!-- toast code here -->
            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
                <div id="createToast" class="toast text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            Post created successfully!
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="../public/assets/js/admin.Create.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>