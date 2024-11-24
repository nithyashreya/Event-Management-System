<?php
// db_config.php - Database connection settings
$host = "localhost";
$db_name = "dummy";
$username = "root";  // Change if necessary
$password = "";      // Change if necessary

// Create a connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>