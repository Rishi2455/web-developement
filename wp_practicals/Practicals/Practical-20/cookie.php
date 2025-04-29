<?php
// filepath: c:\xampp\htdocs\Practical-20\cookie.php

// Save the color in a cookie if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['colorInput'])) {
    $color = htmlspecialchars($_POST['colorInput']);
    setcookie('bgColor', $color, time() + (7 * 24 * 60 * 60), '/'); // Save for 7 days
    header("Location: index.html"); // Redirect back to the form
    exit;
}
?>