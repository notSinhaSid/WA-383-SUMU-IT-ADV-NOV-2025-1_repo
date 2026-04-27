<?php
ob_start(); // ← catches any accidental output
ini_set('display_errors', 1); // ← stops warnings from printing
error_reporting(E_ALL);
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../classes/Post.php');
require_once(__DIR__ . '/../classes/Tag.php');
require_once(__DIR__ . '/../classes/Category.php');
session_start();

$postDbConn = new Database();
$conn = $postDbConn->getConnection();
$postObj = new Post($conn);
$tagObj  = new Tag($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    switch ($action) {
        case 'createPost':
            $postTitle      = $_POST['postTitle'];
            $postContent    = $_POST['postContent'];
            $postTags       = $_POST['postTags'];
            $postCategoryId = $_POST['postCategoryId'];
            $postCoverImage = '';
            if (isset($_SESSION['user'])) {
                $postUserId = $_SESSION['user']['uId'];
            } elseif (isset($_SESSION['admin'])) {
                $postUserId = $_SESSION['admin']['uId'];
            } else {
                $postUserId = null;
            }
            $postStatus     = $_POST['postStatus'] ?? 'draft';

            // check if session contains the userid before creating post
            if(!$postUserId) {
                ob_clean();
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Not logged in, Login to continue',
                ]);
                exit();
            }

            // 1. empty check
            if (empty($postTitle) || empty($postContent) || empty($postTags) || empty($postCategoryId)) {
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Fields are required',
                ]);
                exit();
            }

            // 2. cover image validation
            if (isset($_FILES['postCoverImage']) && $_FILES['postCoverImage']['error'] === 0) {
                $allowedExtension = ['jpeg', 'png', 'jpg'];
                $maxSize          = 3 * 1024 * 1024;
                $mime             = mime_content_type($_FILES['postCoverImage']['tmp_name']);
                $extension        = strtolower(pathinfo($_FILES['postCoverImage']['name'], PATHINFO_EXTENSION));

                if (!in_array($mime, ['image/jpeg', 'image/png']) && !in_array($extension, $allowedExtension)) {
                    echo json_encode([
                        'status'  => 'error',
                        'message' => 'Invalid File type',
                    ]);
                    exit();
                }

                if ($_FILES['postCoverImage']['size'] > $maxSize) {
                    echo json_encode([
                        'status'  => 'error',
                        'message' => 'File too Big',
                    ]);
                    exit();
                }

                $postCoverImage = bin2hex(random_bytes(16)) . '.' . $extension;
                $filePath       = __DIR__ . '/../public/assets/uploads/covers/' . $postCoverImage;

                if (!move_uploaded_file($_FILES['postCoverImage']['tmp_name'], $filePath)) {
                    echo json_encode([
                        'status'  => 'error',
                        'message' => 'Image upload failed, Try again!',
                    ]);
                    exit();
                }
            } else {
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Please provide cover image',
                ]);
                exit();
            }

            // 3. create the post
            $result = $postObj->createPost($postTitle, $postContent, $postCoverImage, $postUserId, $postCategoryId, $postStatus);

            if ($result) {
                $postId = $postObj->getLastInsertId();

                // 5. handle tags — loop through each tag
                $tagsArray = explode(',', $postTags);
                foreach ($tagsArray as $tagName) {
                    $tagName = trim($tagName); // remove extra spaces
                    if (!empty($tagName)) {
                        $tagId = $tagObj->findOrCreateTag($tagName);
                        $tagObj->attachToPost($postId, $tagId);
                    }
                }
                ob_clean();

                echo json_encode([
                    'status'  => 'success',
                    'message' => 'Post created successfully!',
                    'redirect' => '../user/dashboard.php',
                ]);
                exit();
            } else {
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Failed to create post, Try again!',
                ]);
                exit();
            }

            break;
        
        case 'updatePost':
            $postId         = $_POST['postId'];
            $postTitle      = $_POST['postTitle'];
            $postContent    = $_POST['postContent'];
            $postTags       = $_POST['postTags'];
            $postCategoryId = $_POST['postCategoryId'];
            $postCoverImage = '';
            $postUserId     = $_SESSION['user']['uId'];
            $postStatus     = $_POST['postStatus'] ?? 'draft';

            // check for empty field during update
            if (empty($postTitle) || empty($postContent) || empty($postTags) || empty($postCategoryId)) {
                ob_clean();
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Fields are required',
                ]);
                exit();
            }
            // before checking cover image keep the default image at hand if no new image will be updated
            $existingPost = $postObj->getPostById($postId);
            $defaultCoverImage = $existingPost['postCoverImage'];

            // if new image is selected by user , then perform the image check
            if (isset($_FILES['postCoverImage']) && $_FILES['postCoverImage']['error'] === 0) {
                $allowedExtension = ['jpeg', 'png', 'jpg'];
                $maxSize          = 3 * 1024 * 1024;
                $mime             = mime_content_type($_FILES['postCoverImage']['tmp_name']);
                $extension        = strtolower(pathinfo($_FILES['postCoverImage']['name'], PATHINFO_EXTENSION));

                if (!in_array($mime, ['image/jpeg', 'image/png']) && !in_array($extension, $allowedExtension)) {
                    ob_clean();
                    echo json_encode([
                        'status'  => 'error',
                        'message' => 'Invalid File type',
                    ]);
                    exit();
                }

                if ($_FILES['postCoverImage']['size'] > $maxSize) {
                    ob_clean();
                    echo json_encode([
                        'status'  => 'error',
                        'message' => 'File too Big',
                    ]);
                    exit();
                }

                if (!empty($existingPost['postCoverImage'])) {
                    $oldFilePath = __DIR__ . '/../public/assets/uploads/covers/' . $existingPost['postCoverImage'];
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                $postCoverImage = bin2hex(random_bytes(16)) . '.' . $extension;
                $filePath = __DIR__ . '/../public/assets/uploads/covers/' . $postCoverImage;

                if (!move_uploaded_file($_FILES['postCoverImage']['tmp_name'], $filePath)) {
                    ob_clean();
                    echo json_encode([
                        'status'  => 'error',
                        'message' => 'Image upload failed, Try again!',
                    ]);
                    exit();
                }
            } else {
                $postCoverImage = $defaultCoverImage;
            }

            // update function called here
            $result = $postObj->updatePost($postId, $postTitle, $postContent, $postCoverImage, $postCategoryId, $postStatus);

            if ($result) {
                $tagObj->deleteTagByPostId($postId);
                $tagsArray = explode(',', $postTags);
                foreach ($tagsArray as $tagName) {
                    $tagName = trim($tagName);
                    if (!empty($tagName)) {
                        $tagId = $tagObj->findOrCreateTag($tagName);
                        $tagObj->attachToPost($postId, $tagId);
                    }
                }
                ob_clean();
                echo json_encode([
                    'status'  => 'success',
                    'message' => 'Post udpated successfully!',
                    'redirect' => '../user/dashboard.php',
                ]);
                exit();
            } else {
                ob_clean();
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Failed to update post, Try again!',
                ]);
                exit();
            }

            break;

        case 'delete':
            $postId = $_POST['postId'];
            $existingPostForDelete = $postObj->getPostById($postId);

            if(!$existingPostForDelete) {
                ob_clean();
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Post not found',
                ]);
                exit();
            }
            $existingCoverImg = $existingPostForDelete['postCoverImage'];
            $tagObj->deleteTagByPostId($postId);

            if(!empty($existingCoverImg)){
                $oldFilePath = __DIR__ . '/../public/assets/uploads/covers/' . $existingCoverImg;
                if(file_exists($oldFilePath)){
                    unlink($oldFilePath);
                }
            }

            $result = $postObj->deletePost($postId);

            if($result){
                ob_clean();
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Post deleted Successfully',
                ]);
                exit();
            }else {
                ob_clean();
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to delete post, try again!',
                ]);
                exit();
            }
            break;
    }
}