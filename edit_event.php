<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "dummy");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$event_id = 0;
$event_name = $event_description = $event_date = $event_time = $event_location = $event_image = "";
$message = "";

// Fetch event details for editing
if (isset($_GET['id'])) {
    $event_id = intval($_GET['id']);
    $sql = "SELECT * FROM events WHERE event_id = $event_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
        $event_name = $event['event_name'];
        $event_description = $event['event_description'];
        $event_date = $event['event_date'];
        $event_time = $event['event_time'];
        $event_location = $event['event_location'];
        $event_image = $event['event_image'];
    } else {
        $message = "Event not found.";
    }
}

// Update event in the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = intval($_POST['event_id']);
    $event_name = $conn->real_escape_string($_POST['event_name']);
    $event_description = $conn->real_escape_string($_POST['event_description']);
    $event_date = $conn->real_escape_string($_POST['event_date']);
    $event_time = $conn->real_escape_string($_POST['event_time']);
    $event_location = $conn->real_escape_string($_POST['event_location']);

    // Handle new image upload (if any)
    if (!empty($_FILES['event_image']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['event_image']['name']);
        move_uploaded_file($_FILES['event_image']['tmp_name'], $target_file);
        $event_image = $target_file;
    }

    // Update query
    $update_sql = "UPDATE events 
                   SET event_name='$event_name', 
                       event_description='$event_description', 
                       event_date='$event_date', 
                       event_time='$event_time', 
                       event_location='$event_location', 
                       event_image='$event_image' 
                   WHERE event_id=$event_id";

    if ($conn->query($update_sql)) {
        $message = "Event updated successfully!";
    } else {
        $message = "Error updating event: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            max-width: 600px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #d10910;
            border: none;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #b0070d;
        }

        .message {
            color: green;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Edit Event</h2>
        <?php if (!empty($message)): ?>
            <p class="<?php echo strpos($message, 'success') !== false ? 'message' : 'error'; ?>"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="edit_event.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event_id); ?>">

            <div class="form-group">
                <label for="event_name">Event Name</label>
                <input type="text" name="event_name" id="event_name" class="form-control" value="<?php echo htmlspecialchars($event_name); ?>" required>
            </div>

            <div class="form-group">
                <label for="event_description">Event Description</label>
                <textarea name="event_description" id="event_description" class="form-control" rows="4" required><?php echo htmlspecialchars($event_description); ?></textarea>
            </div>

            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="date" name="event_date" id="event_date" class="form-control" value="<?php echo htmlspecialchars($event_date); ?>" required>
            </div>

            <div class="form-group">
                <label for="event_time">Event Time</label>
                <input type="time" name="event_time" id="event_time" class="form-control" value="<?php echo htmlspecialchars($event_time); ?>" required>
            </div>

            <div class="form-group">
                <label for="event_location">Event Location</label>
                <input type="text" name="event_location" id="event_location" class="form-control" value="<?php echo htmlspecialchars($event_location); ?>" required>
            </div>

            <div class="form-group">
                <label for="event_image">Event Image</label>
                <?php if ($event_image): ?>
                    <div class="mb-2">
                        <img src="<?php echo htmlspecialchars($event_image); ?>" alt="Event Image" style="width: 100px; height: auto;">
                    </div>
                <?php endif; ?>
                <input type="file" name="event_image" id="event_image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary btn-block">Update Event</button>
        </form>
    </div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
