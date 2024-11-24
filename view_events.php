<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "dummy");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch events from the database
$sql = "SELECT * FROM events ORDER BY event_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #d10910;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
            position: fixed;
            height: 100%;
        }

        .heading {
            font-size: 22px;
            margin-bottom: 15px;
            color: #fecc16;
            text-align: center;
        }

        .logo-container {
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .nav-links {
            width: 100%;
            text-align: center;
        }

        .nav-links a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #fecc16;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .nav-links a:hover {
            background-color: #b0070d;
        }

        /* Main Content */
        .content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
            background-color: #f8f9fa;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Event Card */
        .card {
            width: 300px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #d10910;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 14px;
            margin-bottom: 10px;
            color: #555;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
        }

        .card-footer a {
            text-decoration: none;
            color: #fecc16;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .card-footer a:hover {
            color: #d10910;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
        <h2 class="heading">Admin Dashboard</h2>
            <div class="logo-container">
                <img src="images/logo.png" alt="Logo" class="logo">
            </div>
           
            <nav class="nav-links">
                <a href="admin-dashboard.php">Home</a>
                <a href="add-event.php">Add Event</a>
                <a href="view-events.php" style="background-color: #b0070d;">View Events</a>
                <a href="edit-events.php">Edit/Delete Events</a>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="content">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($row['event_image']); ?>" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['event_name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['event_description']); ?></p>
                            <p class="card-text">
                                <strong>Date:</strong> <?php echo htmlspecialchars($row['event_date']); ?><br>
                                <strong>Time:</strong> <?php echo htmlspecialchars($row['event_time']); ?><br>
                                <strong>Location:</strong> <?php echo htmlspecialchars($row['event_location']); ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="view-event.php?id=<?php echo $row['event_id']; ?>">View Details</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No events found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
