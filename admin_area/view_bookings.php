<?php
// Include database connection
include '../config/db_connect.php';

// Fetch bookings from the database
$sql = "SELECT b.booking_id, u.name AS user_name, p.title AS property_title, b.booking_date, b.start_date, b.end_date, b.status 
        FROM bookings b
        JOIN users u ON b.user_id = u.user_id
        JOIN properties p ON b.property_id = p.property_id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings - Admin</title>
    <link rel="stylesheet" href="../styles/admin_profile.css">
</head>
<body>
    <div class="container">
        <h1>View Bookings</h1>

        <table class="bookings-table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>User Name</th>
                    <th>Property Title</th>
                    <th>Booking Date</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if bookings exist in the database
                if (mysqli_num_rows($result) > 0) {
                    while ($booking = mysqli_fetch_assoc($result)) {
                        echo '
                        <tr>
                            <td>' . $booking['booking_id'] . '</td>
                            <td>' . $booking['user_name'] . '</td>
                            <td>' . $booking['property_title'] . '</td>
                            <td>' . $booking['booking_date'] . '</td>
                            <td>' . $booking['start_date'] . '</td>
                            <td>' . $booking['end_date'] . '</td>
                            <td>' . ucfirst($booking['status']) . '</td>
                            <td>
                                <a href="edit_booking.php?id=' . $booking['booking_id'] . '" class="btn-edit">Edit</a>
                                <a href="delete_booking.php?id=' . $booking['booking_id'] . '" class="btn-delete" onclick="return confirm(\'Are you sure you want to delete this booking?\')">Delete</a>
                            </td>
                        </tr>';
                    }
                } else {
                    echo '<tr><td colspan="8">No bookings found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
