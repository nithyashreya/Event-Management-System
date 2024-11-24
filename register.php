<?php
session_start();
require_once 'db_config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Check if event_id is set in the POST request
if (isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    // Check if the user is already registered for this event
    $check_sql = "SELECT * FROM registrations WHERE user_id = ? AND event_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ii", $user_id, $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If already registered
        echo "You have already registered for this event.";
    } else {
        // Register the user for the event
        $sql = "INSERT INTO registrations (user_id, event_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $event_id);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "No event selected.";
}
?>
