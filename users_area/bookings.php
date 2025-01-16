<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../config/db_connect.php'; // Include your database connection
$user_id = $_SESSION['user_id'];

// Fetch user's bookings from the database
$sql = "SELECT * FROM bookings WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/user_dashboard.css">
    <title>My Bookings</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="view_properties.php">Browse Properties</a></li>
            <li><a href="wishlist.php">Wishlist</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h2>My Bookings</h2>
    <div class="bookings-list">
        <?php while ($booking = mysqli_fetch_assoc($result)): ?>
            <div class="booking-card">
                <h3>Booking ID: <?php echo $booking['booking_id']; ?></h3>
                <p>Property ID: <?php echo $booking['property_id']; ?></p>
                <p>Status: <?php echo $booking['status']; ?></p>
                <p>Start Date: <?php echo $booking['start_date']; ?></p>
                <p>End Date: <?php echo $booking['end_date']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
