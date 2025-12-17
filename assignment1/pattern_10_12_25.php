<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        $repeat = 4;

        for ($i = 1; $i <= $row; $i++) {
            for ($j = 1; $j <= ($row - $i) * $repeat; $j++) {
                echo "&nbsp;&nbsp;";
            }
            for ($a = 1; $a <= $repeat; $a++) {
                for ($k = 1; $k <= $i; $k++) {
                    echo "A";
                }
                if ($a < $repeat) {
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                }
            }

            echo "<br>";
        }
        ?>
    </div>
</body>

</html>