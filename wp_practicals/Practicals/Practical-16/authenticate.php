<?php
// filepath: c:\xampp\htdocs\authenticate.php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password (use MD5 for simplicity; use stronger hashing like bcrypt in production)
    $hashed_password = md5($password);

    // Check if the user exists
    $sql = "SELECT * FROM authorization WHERE username='$username' AND password='$hashed_password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // User authenticated
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Invalid username or password.";
    }
}

$conn->close();
?>