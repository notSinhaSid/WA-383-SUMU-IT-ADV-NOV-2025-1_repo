<?php
require_once('../config/Database.php');
require_once('../models/postModel.php');

$userObject = new User($pdo);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_POST['action'];

    switch($action) {
        case 'create' :
            $userName = $_POST['userName'];
            $userEmail = $_POST['userEmail'];
            $userPic = $_FILES['userPic']['name'] ?? null;

            if(empty($userEmail) || empty($userEmail)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Fill the required Fields',
                ]);}
            if(isset($_FILES['userPic']) && $_FILES['userPic']['error'] === 0) {
                $allowedExtension = ['jpeg', 'jpg', 'png'];
                $maxSize = 5*1024*1024;

                $userPicTempName = $_FILES['userPic']['tmp_name'];
                $userPicSize = $_FILES['userPic']['size'];
                $userPicOriginalName = $_FILES['userPic']['name'];

                $extension = strtolower(pathinfo($userPicOriginalName, PATHINFO_EXTENSION));

                $mime = mime_content_type($userPicTempName);

                if(!in_array($mime, ['image/jpeg', 'image/jpg', 'image/png']) || !in_array($extension, $allowedExtension)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Invalid File formate',
                    ]);

                    exit;

                }

                if($userPicSize > $maxSize) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'File too big',
                    ]);
                }

                // genrating secure fileName
                $userPic = bin2hex(random_bytes(16)) . '.' .$extension;
                // $userPic = time().'.'.$extension;
                $uploadPath = __DIR__.'/../uploads/'.$userPic;

            }
    }
}