<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Check</title>
</head>
<body>
    <form action="prime.php" method="post">
        <fieldset>
            <legend>Prime Check</legend>
            <label for="num">Enter a number:</label>
            <input type="number" id="num" name="num" required>
            <input type="submit" value="Check">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $num = intval($_POST['num']);
                if ($num < 2) {
                    echo "<p>$num is not a prime number.</p>";
                } else {
                    $is_prime = true;
                    for ($i = 2; $i <= sqrt($num); $i++) {
                        if ($num % $i == 0) {
                            $is_prime = false;
                            break;
                        }
                    }
                    if ($is_prime) {
                        echo "<p>$num is a prime number.</p>";
                    } else {
                        echo "<p>$num is not a prime number.</p>";
                    }
                }
            }
            ?>
        </fieldset>
    </form>
</body>
</html>