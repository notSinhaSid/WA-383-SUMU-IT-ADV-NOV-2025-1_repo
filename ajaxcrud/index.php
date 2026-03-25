<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX CRUD</title>
</head>

<body>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data" id="blogForm">
            <input type="hidden" name="userId" id="userId">
            Author Name : <input type="text" name="userName" id="userName"><br><br>
            Email Name : <input type="email" name="userEmail" id="userEmail"><br><br>
            <input type="file" name="userPic" id="userPic" accept="image/*"><br>

            <input type="hidden" name="action" value="create" id="formAction">

            <div id="display_img"></div>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <!-- personal js file includes -->
    <script src="assets/js/include.js"></script>
</body>

</html>