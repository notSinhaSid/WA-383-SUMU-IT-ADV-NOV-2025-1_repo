<?php
session_start();
require('../includes/functions.php');
checkRole('user');
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../classes/Post.php');
require_once(__DIR__ . '/../classes/Tag.php');

$dbObj = new Database();
$conn = $dbObj->getConnection();

$userID = $_SESSION['user']['uId'];

$userPostObj = new Post($conn);

$keywords = $_GET['search'] ?? '';
$postPerPage = 6;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $postPerPage;
if(!empty($keywords)) {
    $postRetriveVar = $userPostObj->searchPostUsingKeyword($keywords, $postPerPage, $offset, $userID);
    $totalPost = $userPostObj->getTotalSearchCount($keywords, $userID);
    $totalPages = ceil($totalPost / $postPerPage);
}
else {
    $totalPost = $userPostObj->getTotalPostCount($userID);
    $totalPages = ceil($totalPost / $postPerPage);
    $postRetriveVar = $userPostObj->getCurrentUserPostById($userID, $postPerPage, $offset);
}

$tagObj = new Tag($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php
    $navPage = 'dashboard';
    include 'includes/navbar.php';
    ?>

    <div class="container py-5">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">My Posts</h4>
                <p class="text-muted mb-0" style="font-size:14px;">
                    <?php echo count($postRetriveVar); ?> post<?php echo count($postRetriveVar) !== 1 ? 's' : ''; ?> found
                </p>
            </div>
        </div>

        <!-- Posts Grid -->
        <div class="row g-4">

            <?php if (!empty($postRetriveVar)): ?>

                <?php foreach ($postRetriveVar as $posts): ?>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">

                            <?php if (!empty($posts['postCoverImage'])): ?>
                                <img src="<?php echo $siteURL; ?>/public/assets/uploads/covers/<?php echo $posts['postCoverImage']; ?>"
                                    alt="post cover image"
                                    class="card-img-top"
                                    style="height:180px; object-fit:cover;">
                            <?php else: ?>
                                <div class="bg-secondary d-flex align-items-center justify-content-center"
                                    style="height:180px;">
                                    <span class="text-white">No Cover Image available</span>
                                </div>
                            <?php endif; ?>

                            <div class="card-body d-flex flex-column">
                                <div class="d-flex gap-2 mb-2">
                                    <?php
                                    $badgeColors = ['bg-primary', 'bg-success', 'bg-warning', 'bg-secondary', 'bg-info'];
                                    $tags = $tagObj->getTagByPostId($posts['postId']);
                                    foreach ($tags as $index => $tag): ?>
                                        <span class="badge <?php echo $badgeColors[$index % count($badgeColors)]; ?>" style="font-size:11px;">
                                            <?php echo htmlspecialchars($tag); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>

                                <h6 class="fw-bold mb-1">
                                    <?php echo htmlspecialchars($posts['postTitle']); ?>
                                </h6>

                                <p class="text-muted mb-3" style="font-size:13px;">
                                    <?php echo substr(strip_tags($posts['postContent']), 0, 100) . '...'; ?>
                                </p>

                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <small class="text-muted">
                                        <?php echo date("jS M, Y", strtotime($posts['created_at'])); ?>
                                    </small>
                                    <div class="d-flex gap-2">
                                        <a href="editPost.php?id=<?php echo $posts['postId']; ?>"
                                            class="btn btn-sm btn-outline-primary">Edit</a>
                                        <button class="btn btn-sm btn-outline-danger delete-btn" data-id="<?php echo $posts['postId']; ?>">Delete</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <!-- Empty State -->
                <div class="col-12 text-center py-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="#94a3b8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <h6 class="mt-3 text-muted">No posts yet</h6>
                    <p class="text-muted" style="font-size:13px;">You haven't written anything yet.</p>
                </div>
            <?php endif; ?>

        </div>
        <?php if ($totalPages > 1): ?>
            <div class="d-flex justify-content-center mt-5">
                <nav>
                    <ul class="pagination">
                        <!-- Previous -->
                        <li class="page-item <?php echo $currentPage == 1 ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                </svg>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php echo $currentPage == $i ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <!-- Next -->
                        <li class="page-item <?php echo $currentPage == $totalPages ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>
    <!-- Toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="deleteToast" class="toast align-items-center text-white bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    Post deleted successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-4.0.0.js"></script>
    <script src="../public/assets/js/deletePost.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>