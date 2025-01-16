<?php
include '../config/db_connect.php';

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Delete booking from the database
    $sql = "DELETE FROM bookings WHERE booking_id = $booking_id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Booking deleted successfully!'); window.location.href='view_bookings.php';</script>";
    } else {
        echo "<script>alert('Error deleting booking.');</script>";
    }
}
?>
