<?php
// filepath: c:\xampp\htdocs\Practical-17\getState.php

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

// Check if the 'user' parameter is set
if (isset($_GET['user'])) {
    $user = $conn->real_escape_string($_GET['user']);
    // Query to fetch matching users
    $sql = "SELECT name, mobile, email FROM users WHERE name LIKE '%$user%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['mobile']}</td>
                    <td>{$row['email']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No matching users found.";
    }
}

$conn->close();
?>