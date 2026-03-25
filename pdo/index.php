<?php
require_once('config/dbConfigClass.php');
require_once('requester/classes/requesterClass.php');

$dbObject = new Database();
$dbResponse = $dbObject->dbConnectionGenerator();

$userObject = new User($dbResponse);
$userRetrive = $userObject->retriveAll();

/* echo '<pre>';
print_r($dbResponse);
echo '</pre>'; */

include_once('requester/insert.inc.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO tutorials</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <script>
        function validateForm() {
            var uName = document.forms["uRegisterForm"]["uName"].value.trim();
            var uEmail = document.forms["uRegisterForm"]["uEmail"].value.trim();
            var uPhone = document.forms["uRegisterForm"]["uPhone"].value.trim();
            if (uName === "" || uEmail === "" || uPhone === "") {
                alert("All fields must be filled out");
                return false;
            }
            var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!uEmail.match(emailPattern)) {
                alert("Invalid email address");
                return false;
            }
            return true;
        }
    </script>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="container">
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" name="uRegisterForm">
                        NAME : <input type="text" name="uName" id="uName" placeholder="Enter your name" value=""><br>
                        EMAIL : <input type="email" name="uEmail" id="uEmail" placeholder="Enter your email" value=""><br>
                        PHONE : <input type="number" name="uPhone" id="uPhone" value=""><br>
                        PROFILE IMAGE : <input type="file" name="uProfile" id="uProfile"><br><br>
                        <button type="submit" name="uRegister">Register</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <table class="table" border="1" cellpadding="10">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Profile</th>
                            <th>Actions</th>
                
                        </tr>
                    </thead>
                    <?php while ($row = $userRetrive->fetch(PDO::FETCH_ASSOC)): ?>
                        <tbody>
                            <tr>
                                <td><?php echo htmlspecialchars($row['uId']); ?></td>
                                <td><?php echo htmlspecialchars($row['uName']); ?></td>
                                <td><?php echo htmlspecialchars($row['uEmail']); ?></td>
                                <td><?php echo htmlspecialchars($row['uPhone']); ?></td>
                                <td>
                                    <?php if ($row['uProfile']): ?>
                                        <?php if (file_exists(__DIR__ . "/images/" . htmlspecialchars($row['uProfile']))) { ?>
                                            <img src="images/<?php echo htmlspecialchars($row['uProfile']); ?>" height="50">
                                        <?php } else {
                                            echo "No Image";
                                        } ?>
                                    <?php else: ?>
                                        Image not Available
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="update.php?id=<?php echo $row['uId']; ?>">Edit</a> |
                                    <a href="requester/deleted.inc.php?uId=<?php echo $row['uId']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>