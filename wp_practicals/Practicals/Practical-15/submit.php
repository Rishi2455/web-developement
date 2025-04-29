<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit</title>
</head>

<body>
    <nav>
        <a href="../Practical-4/index.html">Register New User</a> |
        <a href="manage.php">Manage Users</a>
    </nav>
    <?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "wp";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $dob = $_POST["dob"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $mobile = $_POST["mobile"];
        $address = $_POST["address"];
        $state = $_POST["state"];
        $education = implode(",", $_POST["education"]);

        // Handle file upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $image_path = "";
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        } else {
            die("Error uploading file.");
        }

        // Insert data into the database
        $sql = "INSERT INTO users (name, dob, gender, email, mobile, address, state, education, image_path)
                VALUES ('$name', '$dob', '$gender', '$email', '$mobile', '$address', '$state', '$education', '$image_path')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>
</body>

</html>