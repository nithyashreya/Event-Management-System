<?php
// Start the session
session_start();

// Include the database connection file
include('db_config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the login credentials from the form
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];

    // Sanitize the input to prevent SQL Injection
    $admin_username = mysqli_real_escape_string($conn, $admin_username);
    $admin_password = mysqli_real_escape_string($conn, $admin_password);

    // SQL query to check if the admin exists in the database
    $sql = "SELECT * FROM admin_login WHERE username = '$admin_username'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the username exists
    if (mysqli_num_rows($result) > 0) {
        // Fetch the admin data
        $row = mysqli_fetch_assoc($result);

        // Check if the provided password matches the stored password
        if ($admin_password === $row['password']) {  // In this example, the password is stored in plain text
            // Password is correct, create a session for the admin
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $row['username']; // Optional: store the username in session

            // Redirect to the admin dashboard
            header("Location: view_events.php");
            exit();
        } else {
            // Invalid password
            $_SESSION['error_message'] = "Invalid username or password.";
            header("Location: admin_login.php");
            exit();
        }
    } else {
        // Admin does not exist
        $_SESSION['error_message'] = "Invalid username or password.";
        header("Location: admin_login.php");
        exit();
    }
} else {
    // Redirect to login page if form is not submitted
    header("Location: admin_login.php");
    exit();
}
?>
