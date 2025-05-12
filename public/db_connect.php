<?php
$servername = "localhost";
$username = "root";  // Default username for XAMPP
$password = "";      // Default password is empty for XAMPP
$dbname = "user_db"; // Ensure this matches the database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
