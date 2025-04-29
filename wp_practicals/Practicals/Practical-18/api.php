<?php
header("Content-Type:application/json");

// Check if PATH_INFO is set
if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != "") {
    include('db.php');
    // Extract the ID from PATH_INFO
    $pathInfo = trim($_SERVER['PATH_INFO'], '/'); // Remove leading/trailing slashes
    $idno = intval($pathInfo); // Convert to integer for safety

    // Query the database
    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE id=$idno");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $name = $row['name'];
        $email = $row['email'];
        response($idno, $name, $email);
    } else {
        errorResponse("No Record Found","Check the ID you provided");
    }

    mysqli_close($conn);
} else {
    errorResponse("Invalid Request","URL must contain ID");
}

function response($idno, $name, $email)
{
    $response = [
        'id' => $idno,
        'name' => $name,
        'email' => $email
    ];

    echo json_encode($response);
}

function errorResponse($message,$hint)
{
    $response = [
        'error' => $message,
        'hint' => $hint
    ];

    echo json_encode($response);
}
?>