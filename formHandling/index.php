<?php
session_start();

if(!isset($_SESSION['id'])) {
    $_SESSION['id'] = rand(11111, 99999);
}
/* else{
    echo '<script>location.href="formResponse.php"</script>';
} */


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form handling</title>
</head>
<body>
    <form action="formResponse.php" method="post">
        NAME: <input type="text" placeholder="Your name" name="name"><br>
        AGE: <input type="number" placeholder="Your age" name="age"><br>
        EMAIL: <input type="email" placeholder="Your Email" name="email"><br>
        <input type="text" value="<?php echo $_SESSION['id']; ?>" name="id">
        PHONE NUMBER: <input type="number" placeholder="Your Phone number" name="phnNumber"><br><br>

        <button name="register">Register</button>
    </form>
</body>
</html>