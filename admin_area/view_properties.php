<?php
// Include database connection
include '../config/db_connect.php';

// Fetch properties from the database
$sql = "SELECT * FROM properties";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Properties - Admin</title>
    <link rel="stylesheet" href="../styles/admin_profile.css">
</head>
<body>
    <div class="container">
        <h1>View Properties</h1>

        <table class="properties-table">
            <thead>
                <tr>
                    <th>Property ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Location</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if properties exist in the database
                if (mysqli_num_rows($result) > 0) {
                    while ($property = mysqli_fetch_assoc($result)) {
                        echo '
                        <tr>
                            <td>' . $property['property_id'] . '</td>
                            <td>' . $property['title'] . '</td>
                            <td>' . substr($property['description'], 0, 50) . '...</td>
                            <td>$' . $property['price'] . '</td>
                            <td>' . $property['location'] . '</td>
                            <td>' . ucfirst($property['type']) . '</td>
                            <td>
                                <a href="edit_property.php?id=' . $property['property_id'] . '" class="btn-edit">Edit</a>
                                <a href="delete_property.php?id=' . $property['property_id'] . '" class="btn-delete" onclick="return confirm(\'Are you sure you want to delete this property?\')">Delete</a>
                            </td>
                        </tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">No properties found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
