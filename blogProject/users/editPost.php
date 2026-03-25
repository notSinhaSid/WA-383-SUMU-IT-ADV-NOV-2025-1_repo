<?php
session_start();
require_once(__DIR__ . '/../includes/functions.php');
checkRole('user');
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../classes/Post.php');
require_once(__DIR__ . '/../classes/Tag.php');
require_once(__DIR__ . '/../classes/Category.php');

$dbObj = new Database();
$conn = $dbObj->getConnection();

$postObj = new Post($conn);
$postId = $_GET['id'] ?? $_POST['postId'] ?? null;

if (!$postId) {
    header('Location: dashboard.php');
    exit();
}
$post = $postObj->getPostById($postId);

$tagObj = new Tag($conn);
$getTagForPost = $tagObj->getTagByPostId($postId);

$obtainedTagsNames = [];
$obtainedTagsNames = implode(',', $getTagForPost);

$catObj = new Category($conn);
$getCategory = $catObj->getCategoryAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../users/assets/css/create.css">
</head>

<body>

    <!-- Navbar -->
    <?php
    $navPage = 'edit_post';
    include 'includes/navbar.php';
    ?>

    <!-- Create Post Layout -->
    <form id="createPostForm" enctype="multipart/form-data">
        <input type="hidden" name="postId" value="<?php echo $post['postId']; ?>">
        <input type="hidden" name="action" value="updatePost">

        <div class="create-post-wrapper">

            <!-- Left Column -->
            <div class="left-col">

                <!-- Title -->
                <div>
                    <label class="form-label">Post Title</label>
                    <input type="text" name="postTitle" id="postTitle" class="form-control" placeholder="Enter your post title..." value="<?php echo $post['postTitle']; ?>">
                </div>

                <!-- Cover Image -->
                <div>
                    <label class="form-label">Cover Image</label>
                    <div class="cover-upload">
                        <?php if (!empty($post['postCoverImage'])) : ?>
                            <img src="<?php echo $siteURL; ?>/public/assets/uploads/covers/<?php echo $post['postCoverImage']; ?>"
                                alt="post cover image"
                                class="card-img-top"
                                style="height:180px; object-fit:cover;">
                        <?php else : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="#94a3b8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <p class="text-muted mt-2 mb-2" style="font-size:13px;">Click to upload cover image</p>
                        <?php endif; ?>
                        <input type="file" name="postCoverImage" id="postCoverImage" class="form-control" accept="image/*">
                        <small class="text-muted" style="font-size:11px;">JPG, PNG up to 3MB</small>
                    </div>
                </div>
                <!-- Category -->
                <div>
                    <label class="form-label fw-semibold">Category</label>
                    <select name="postCategoryId" id="postCategoryId" class="form-select">
                        <?php foreach($getCategory as $category):?>
                        <option value="<?php echo $category['catId'] ?>" <?php echo $post['postCategoryId'] == $category['catId'] ? 'selected' : ''; ?>><?php echo $category['catName']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-muted" style="font-size:11px;">Select a category for your post</small>
                </div>

                <!-- Tags -->
                <div>
                    <label class="form-label">Tags</label>
                    <input type="text" name="postTags" id="postTags" class="form-control" value="<?php echo $obtainedTagsNames; ?>">
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
                    placeholder="Write your post content here..."><?php echo htmlspecialchars($post['postContent']); ?></textarea>
            </div>

        </div>
        <div id="formMessage"></div>
    </form>


    <script src="https://code.jquery.com/jquery-4.0.0.js"></script>
    <script src="../public/assets/js/updatePost.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>