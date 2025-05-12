<?php
// db_connection.php

// Database configuration
$servername = "localhost";  // Database server (keep it localhost if you're using XAMPP)
$username = "root";         // Default XAMPP username
$password = "";             // Default XAMPP password (blank)
$database = "mentors";  // Your database name

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If connection is successful, you can remove or comment this after testing
// echo "Database connected successfully!";
?>
