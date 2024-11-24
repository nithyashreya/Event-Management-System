<?php
// Include database configuration (adjust your connection accordingly)
require_once 'db_config.php'; 
include 'header.php';
// Fetch events from the database
$sql = "SELECT * FROM events";
$result = $conn->query($sql);
?>

<div class="events mt-5" id="events">
    <div class="section-top">
        <h1 class="event-section-head">Events</h1>
    </div>
</div>
<div class="container-fluid event-container">
    <div class="row mt-4">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="col-md-4 col-sm-6 col-12 mb-4">
                <div class="card events-card" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row['event_id']; ?>">
                    <img src="<?php echo $row['event_image']; ?>" class="img-top p-2 events-img">
                    <div class="card-body events-card-body">
                        <div class="card-title"><?php echo $row['event_name']; ?></div>
                        <p class="card-text"><?php echo $row['event_description']; ?></p>
                        <div class="tags events-tags">
                            <span><i class="fa-solid fa-location-dot fa-xl" style="color: #d10910;"></i> <?php echo $row['event_location']; ?></span>
                            <span><i class="fa-solid fa-calendar-days fa-xl" style="color: #d10910;"></i> <?php echo $row['event_date']; ?></span>
                            <span><i class="fa-regular fa-clock fa-xl" style="color: #d10910;"></i> <?php echo date('h:i A', strtotime($row['event_time'])); ?></span>
                        </div>
                        <div class="btn-container events-btns">
                            <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row['event_id']; ?>">More Details</button>
                            <!-- Register button inside the card -->
                            <form method="POST" action="register.php" class="d-inline">
                                <input type="hidden" name="event_id" value="<?php echo $row['event_id']; ?>">
                                <button type="submit" class="btn btn-custom">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for event -->
            <div class="modal fade" id="modal<?php echo $row['event_id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $row['event_id']; ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body d-flex">
                            <img src="<?php echo $row['event_image']; ?>" class="img-fluid" style="width: 50%;">
                            <div class="ms-3">
                                <h5 class="modal-title" id="modalLabel<?php echo $row['event_id']; ?>"><?php echo $row['event_name']; ?></h5>
                                <p class="counselor-info"><strong>Student Counselor:</strong> <?php echo $row['event_counselor']; ?></p>
                                <p class="counselor-info"><strong>Club Name:</strong> <?php echo $row['event_club']; ?></p>
                                <p class="card-text more-description"><?php echo $row['longer_description']; ?></p>
                                <p><strong>Location:</strong> <?php echo $row['event_location']; ?></p>
                                <p><strong>Date:</strong> <?php echo $row['event_date']; ?></p>
                                <p><strong>Time:</strong> <?php echo date('h:i A', strtotime($row['event_time'])); ?></p>
                                <button class="btn btn-custom mt-3">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

