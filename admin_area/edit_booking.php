<?php
include '../config/db_connect.php';

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Fetch booking details from the database
    $sql = "SELECT * FROM bookings WHERE booking_id = $booking_id";
    $result = mysqli_query($conn, $sql);
    $booking = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $status = $_POST['status'];

    // Update booking status in the database
    $sql = "UPDATE bookings SET status = '$status' WHERE booking_id = $booking_id";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Booking updated successfully!'); window.location.href='view_bookings.php';</script>";
    } else {
        echo "<script>alert('Error updating booking.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="../styles/admin_profile.css">
</head>
<body>
    <div class="container">
        <h1>Edit Booking</h1>

        <form action="" method="POST">
            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="pending" <?php if ($booking['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                <option value="confirmed" <?php if ($booking['status'] == 'confirmed') echo 'selected'; ?>>Confirmed</option>
            </select>

            <button type="submit" name="update">Update Booking</button>
        </form>
    </div>
</body>
</html>
