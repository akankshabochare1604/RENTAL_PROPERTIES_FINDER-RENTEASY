<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']); // Check if the user is logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/user_dashboard.css">
    <title>Home</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <?php if ($is_logged_in): ?>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="view_properties.php">Browse Properties</a></li>
                <li><a href="bookings.php">My Bookings</a></li>
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <h1>Welcome to the Rental Properties Finder</h1>
    <p>Browse through a variety of rental properties available in your area.</p>
</body>
</html>
