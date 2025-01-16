<?php
include '../config/db_connect.php';

$result = mysqli_query($conn, "SELECT * FROM properties");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div>";
    echo "Title: " . $row['title'] . "<br>";
    echo "Price: " . $row['price'] . "<br>";
    echo "<a href='edit_property.php?property_id=" . $row['property_id'] . "'>Edit</a>";
    echo "<a href='delete_property.php?property_id=" . $row['property_id'] . "'>Delete</a>";
    echo "</div>";
}
?>
