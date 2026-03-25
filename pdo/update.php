<?php
require_once('config/dbConfigClass.php');
require_once('requester/classes/requesterClass.php');

$dbObject = new Database();
$dbResponse = $dbObject->dbConnectionGenerator();

$userObject = new User($dbResponse);

// Get user ID from query parameter
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
} else {
    $uId = intval($_GET['id']);
    $currUser = $userObject->getCurrUser($uId);
    if (!$currUser) {
        header("Location: index.php");
        exit;
    }
}

include_once('requester/update.inc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User - PDO tutorials</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <script>
        function validateForm() {
            var uName = document.forms["uUpdateForm"]["uName"].value.trim();
            var uEmail = document.forms["uUpdateForm"]["uEmail"].value.trim();
            var uPhone = document.forms["uUpdateForm"]["uPhone"].value.trim();
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
            <div class="col-lg-6 offset-lg-3">
                <h2 class="mb-4">Update User Information</h2>
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" name="uUpdateForm">
                            <input type="hidden" name="uId" value="<?php echo htmlspecialchars($currUser['uId']); ?>">
                            
                            <div class="mb-3">
                                <label for="uName" class="form-label">NAME:</label>
                                <input type="text" class="form-control" name="uName" id="uName" placeholder="Enter your name" value="<?php echo htmlspecialchars($currUser['uName']); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="uEmail" class="form-label">EMAIL:</label>
                                <input type="email" class="form-control" name="uEmail" id="uEmail" placeholder="Enter your email" value="<?php echo htmlspecialchars($currUser['uEmail']); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="uPhone" class="form-label">PHONE:</label>
                                <input type="number" class="form-control" name="uPhone" id="uPhone" value="<?php echo htmlspecialchars($currUser['uPhone']); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="uProfile" class="form-label">PROFILE IMAGE:</label>
                                <?php if ($currUser['uProfile']): ?>
                                    <div class="mb-2">
                                        <p class="text-muted">Current Image:</p>
                                        <?php if (file_exists(__DIR__ . "/images/" . htmlspecialchars($currUser['uProfile']))) { ?>
                                            <img src="images/<?php echo htmlspecialchars($currUser['uProfile']); ?>" height="100" class="img-thumbnail">
                                        <?php } ?>
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="form-control" name="uProfile" id="uProfile">
                                <small class="form-text text-muted">Leave empty to keep the current image</small>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary" name="uUpdate">Update</button>
                                <a href="index.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
