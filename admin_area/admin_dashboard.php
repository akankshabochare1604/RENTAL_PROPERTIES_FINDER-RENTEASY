<?php
include '../config/db_connect.php';
session_start();

// Ensure the admin is logged in, otherwise redirect to login page
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetching overall data for admin dashboard statistics
$total_properties = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM properties"))['count'];
$total_bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM bookings"))['count'];
$total_payments = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM payments WHERE status = 'done'"))['count'];
$total_pending_payments = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM payments WHERE status = 'pending'"))['count'];
$total_processing_payments = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM payments WHERE status = 'processing'"))['count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../styles/dashboard.css"> <!-- Add your styling here -->
</head>
<body>
    <div class="navbar">
        <h1>Admin Dashboard</h1>
        <ul>
            <li><a href="admin_profile.php">Profile</a></li>
            <li><a href="view_properties.php">Total Properties (<?php echo $total_properties; ?>)</a></li>
            <li><a href="view_bookings.php">Total Bookings (<?php echo $total_bookings; ?>)</a></li>
            <li><a href="view_payments.php">Payments (Done: <?php echo $total_payments; ?>)</a></li>
            <li><a href="view_pending_payments.php">Pending Payments (<?php echo $total_pending_payments; ?>)</a></li>
            <li><a href="processing_payments.php">Processing Payments (<?php echo $total_processing_payments; ?>)</a></li>
            <li><a href="view_users.php">View Users</a></li>
            <li><a href="login.php">Login</a></li>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="signup.php">Sign Up</a></li>
        </ul>
    </div>

    <div class="dashboard-content">
        <h2>Welcome, Admin</h2>
        <p>Here you can manage all properties, bookings, payments, and users.</p>

        <!-- Section for Properties Management -->
        <h3>Manage Properties</h3>
        <a href="add_property.php">Add New Property</a>
        <a href="view_properties.php">View/Edit/Remove Properties</a>

        <!-- Section for Payments Management -->
        <h3>Manage Payments</h3>
        <p>Done Payments: <?php echo $total_payments; ?></p>
        <p>Pending Payments: <?php echo $total_pending_payments; ?></p>
        <p>Processing Payments: <?php echo $total_processing_payments; ?></p>

        <!-- Section for Bookings Management -->
        <h3>Manage Bookings</h3>
        <a href="view_bookings.php">View Pending/Confirmed Bookings</a>

        <!-- Section for Profile Management -->
        <h3>Manage Profile</h3>
        <a href="admin_profile.php">Update Profile</a>
    </div>
</body>
</html>
