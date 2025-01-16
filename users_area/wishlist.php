<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../config/db_connect.php'; // Include your database connection
$user_id = $_SESSION['user_id'];

// Fetch user's wishlist from the database
$sql = "SELECT * FROM wishlist WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/user_dashboard.css">
    <title>My Wishlist</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="view_properties.php">Browse Properties</a></li>
            <li><a href="bookings.php">My Bookings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h2>My Wishlist</h2>
    <div class="wishlist-list">
        <?php while ($item = mysqli_fetch_assoc($result)): ?>
            <div class="wishlist-card">
                <h3>Property ID: <?php echo $item['property_id']; ?></h3>
                <p>Added on: <?php echo $item['added_on']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
