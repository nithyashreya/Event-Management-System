<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection file
require_once 'db_config.php';

// Get user ID and username from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Define the current date for upcoming and past events
$current_date = date('Y-m-d');

// SQL queries for past and upcoming events
$sql_past_events = "SELECT e.event_name, e.event_date 
                    FROM events e 
                    INNER JOIN registrations r ON e.event_id = r.event_id 
                    WHERE r.user_id = ? AND e.event_date < ? 
                    ORDER BY e.event_date DESC";

$sql_upcoming_events = "SELECT e.event_name, e.event_date, e.event_id 
                        FROM events e 
                        INNER JOIN registrations r ON e.event_id = r.event_id 
                        WHERE r.user_id = ? AND e.event_date >= ? 
                        ORDER BY e.event_date ASC";

// Fetch past events
if ($stmt_past = $conn->prepare($sql_past_events)) {
    $stmt_past->bind_param("is", $user_id, $current_date);
    $stmt_past->execute();
    $result_past = $stmt_past->get_result();
} else {
    echo "Error preparing past events query: " . $conn->error;
}

// Fetch upcoming events
if ($stmt_upcoming = $conn->prepare($sql_upcoming_events)) {
    $stmt_upcoming->bind_param("is", $user_id, $current_date);
    $stmt_upcoming->execute();
    $result_upcoming = $stmt_upcoming->get_result();
} else {
    echo "Error preparing upcoming events query: " . $conn->error;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
        }
        .container {
            margin-top: 50px;
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            color: #d10910;
            border-bottom: 2px solid #fecc16;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .event-list {
            list-style-type: none;
            padding: 0;
        }
        .event-list li {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
        }
        .event-list li:nth-child(even) {
            background-color: #f1f1f1;
        }
        .event-date {
            color: #666;
            font-size: 0.9em;
        }
        .cancel-btn {
            background-color: #d10910;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .cancel-btn:hover {
            background-color: #c1080f;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>


    <!-- Upcoming Events -->
    <h3>Upcoming Events</h3>
    <ul class="event-list">
        <?php if ($result_upcoming && $result_upcoming->num_rows > 0): ?>
            <?php while ($row = $result_upcoming->fetch_assoc()): ?>
                <li>
                    <span><?php echo htmlspecialchars($row['event_name']) . " on " . htmlspecialchars($row['event_date']); ?></span>
                    <form action="cancel_registration.php" method="POST">
                        <input type="hidden" name="event_id" value="<?php echo $row['event_id']; ?>">
                        <button type="submit" class="cancel-btn">Cancel Registration</button>
                    </form>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li>No upcoming events.</li>
        <?php endif; ?>
    </ul>

    <!-- Past Events -->
    <h3>Past Events</h3>
    <ul class="event-list">
        <?php if ($result_past && $result_past->num_rows > 0): ?>
            <?php while ($row = $result_past->fetch_assoc()): ?>
                <li><?php echo htmlspecialchars($row['event_name']) . " on " . htmlspecialchars($row['event_date']); ?></li>
            <?php endwhile; ?>
        <?php else: ?>
            <li>No past events.</li>
        <?php endif; ?>
    </ul>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
