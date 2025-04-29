<?php
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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        die("User not found or query failed.");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $address = $_POST["address"];
    $state = $_POST["state"];
    
    // Check if education is set and is an array
    $education = isset($_POST["education"]) && is_array($_POST["education"]) 
        ? implode(",", $_POST["education"]) 
        : "";

    $sql = "UPDATE users SET name='$name', dob='$dob', gender='$gender', email='$email', mobile='$mobile', address='$address', state='$state', education='$education' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully!";
        header("Location: manage.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <h1>Update User</h1>
    <form method="post" action="update.php">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>"><br>
        <label>DOB:</label>
        <input type="date" name="dob" value="<?php echo $user['dob']; ?>"><br>
        <label>Gender:</label>
        <input type="text" name="gender" value="<?php echo $user['gender']; ?>"><br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>"><br>
        <label>Mobile:</label>
        <input type="text" name="mobile" value="<?php echo $user['mobile']; ?>"><br>
        <label>Address:</label>
        <textarea name="address"><?php echo $user['address']; ?></textarea><br>
        <label>State:</label>
        <input type="text" name="state" value="<?php echo $user['state']; ?>"><br>
        <label>Education:</label><br>
        <?php
        $educationArray = explode(",", $user['education']); // Convert the stored string back to an array
        $educationOptions = ["SSC", "HSC", "Graduation", "Post Graduation"]; // Define all possible options
        foreach ($educationOptions as $option) {
            $checked = in_array($option, $educationArray) ? "checked" : ""; // Check if the option is selected
            echo "<input type='checkbox' name='education[]' value='$option' $checked> $option<br>";
        }
        ?>
        <input type="submit" value="Update">
    </form>
</body>
</html>