<?php
include '../config/db_connect.php';

if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    // Fetch property details from the database
    $sql = "SELECT * FROM properties WHERE property_id = $property_id";
    $result = mysqli_query($conn, $sql);
    $property = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $type = $_POST['type'];

    // Update property in the database
    $sql = "UPDATE properties SET title = '$title', description = '$description', price = '$price', location = '$location', type = '$type' WHERE property_id = $property_id";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Property updated successfully!'); window.location.href='view_properties.php';</script>";
    } else {
        echo "<script>alert('Error updating property.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>
    <link rel="stylesheet" href="../styles/admin_profile.css">
</head>
<body>
    <div class="container">
        <h1>Edit Property</h1>

        <form action="" method="POST">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo $property['title']; ?>" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?php echo $property['description']; ?></textarea>

            <label for="price">Price:</label>
            <input type="number" name="price" id="price" value="<?php echo $property['price']; ?>" required>

            <label for="location">Location:</label>
            <input type="text" name="location" id="location" value="<?php echo $property['location']; ?>" required>

            <label for="type">Type:</label>
            <select name="type" id="type" required>
                <option value="villa" <?php if ($property['type'] == 'villa') echo 'selected'; ?>>Villa</option>
                <option value="apartment" <?php if ($property['type'] == 'apartment') echo 'selected'; ?>>Apartment</option>
                <option value="house" <?php if ($property['type'] == 'house') echo 'selected'; ?>>House</option>
                <option value="commercial" <?php if ($property['type'] == 'commercial') echo 'selected'; ?>>Commercial</option>
            </select>

            <button type="submit" name="update">Update Property</button>
        </form>
    </div>
</body>
</html>
