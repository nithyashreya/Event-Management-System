<?php
session_start();
require_once "db_config.php"; // include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input and sanitize it
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST["password"]);
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Invalid email format.</p>";
    } else {
        // Prepare an SQL statement to check if the user exists
        $sql = "SELECT user_id, username, email, password FROM users WHERE email = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);  // Bind the email to the statement
            
            // Execute the query
            if ($stmt->execute()) {
                $stmt->store_result();
                
                // Check if the email exists in the database
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($user_id, $username, $email_db, $hashed_password);
                    if ($stmt->fetch()) {
                        // Verify the password
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $user_id;  // Consistent session key
                            $_SESSION["username"] = $username;
                            $_SESSION["email"] = $email_db;

                            // Redirect user to welcome page or dashboard
                            header("Location: index.php");
                            exit;
                        } else {
                            // Password is not valid
                            echo "<p>Invalid password. Please try again.</p>";
                        }
                    }
                } else {
                    // No user found with that email address
                    echo "<p>No account found with that email.</p>";
                }
            } else {
                echo "<p>Something went wrong. Please try again later.</p>";
            }
            
            // Close the statement
            $stmt->close();
        }
        
        // Close the connection
        $conn->close();
    }
}
?>
