<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']); // Check if user is logged in
$role = $is_logged_in ? $_SESSION['role'] : 'guest'; // Default role is guest

// Greeting based on user role
$greeting = $is_logged_in ? ($role == 'owner' ? "Owner Dashboard" : "Tenant Dashboard") : "Guest Dashboard";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/user_dashboard.css">
    <title><?php echo $greeting; ?></title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>

            <!-- Profile link (Visible to all logged-in users) -->
            <?php if ($is_logged_in): ?>
                <li><a href="profile.php">Profile</a></li>

                <!-- Browse Properties (Visible to all logged-in users) -->
                <li><a href="view_properties.php">Browse Properties</a></li>

                <!-- My Bookings (Visible to tenants) -->
                <?php if ($role == 'tenant'): ?>
                    <li><a href="bookings.php">My Bookings</a></li>
                <?php endif; ?>

                <!-- Wishlist (Visible to all logged-in users) -->
                <li><a href="wishlist.php">Wishlist</a></li>

                <!-- Logout (Visible to all logged-in users) -->
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <!-- Sign In and Login (Visible to guests only) -->
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="welcome-section">
        <h1><?php echo $greeting; ?></h1>
        <p><?php echo $is_logged_in ? "Manage your account, properties, and bookings." : "Sign up or log in to start managing your properties."; ?></p>
    </div>
</body>
</html>
