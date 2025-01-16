<?php
session_start();
include '../config/db_connect.php'; // Include your database connection

// Fetch properties from the database
$sql = "SELECT * FROM properties";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/user_dashboard.css">
    <title>View Properties</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="bookings.php">My Bookings</a></li>
            <li><a href="wishlist.php">Wishlist</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h2>Browse Properties</h2>
    <div class="properties-list">
        <?php while ($property = mysqli_fetch_assoc($result)): ?>
            <div class="property-card">
                <img src="../property_img/<?php echo $property['property_images']; ?>" alt="Property Image">
                <h3><?php echo $property['title']; ?></h3>
                <p><?php echo $property['description']; ?></p>
                <p>Location: <?php echo $property['location']; ?></p>
                <p>Price: $<?php echo $property['price']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
  