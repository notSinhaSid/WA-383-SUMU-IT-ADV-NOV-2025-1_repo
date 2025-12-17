<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Square Pyramid Pattern Program</title>

    <style>
        .container {
            margin-left: 12rem;
            margin-right: 12rem;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php

            $row = 5;

            for($i = 1; $i <= $row; $i++) {
                for($j = 1; $j <= ($row - $i); $j++) {
                    echo "A";
                }
                echo "<br>";
                /* for ($j = 1; $j < $i; $j++) {
                    $k = $i;
                    echo "A";
                    $k++;
                } */
                // echo "<br>";
            }
            for ($i = 1; $i <= $row; $i++) {
                for ($j = 1; $j < $i; $j++) {
                    $k = $i;
                    echo "A";
                    $k++;
                }
                echo "<br>";
            }
        ?>
    </div>
</body>

</html>