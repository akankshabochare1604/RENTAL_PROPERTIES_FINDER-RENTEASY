<?php
include '../config/db_connect.php';

if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    // Delete property from the database
    $sql = "DELETE FROM properties WHERE property_id = $property_id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Property deleted successfully!'); window.location.href='view_properties.php';</script>";
    } else {
        echo "<script>alert('Error deleting property.');</script>";
    }
}
?>
