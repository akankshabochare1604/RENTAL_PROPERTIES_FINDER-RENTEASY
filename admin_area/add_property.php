<?php
include '../config/db_connect.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $type = $_POST['type'];

    // File upload
    $image = $_FILES['property_image']['name'];
    $image_tmp = $_FILES['property_image']['tmp_name'];
    $image_folder = "../assets/images/" . $image;

    move_uploaded_file($image_tmp, $image_folder);

    $sql = "INSERT INTO properties (user_id, title, description, price, location, type, property_images)
            VALUES (1, '$title', '$description', '$price', '$location', '$type', '$image')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Property added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title" required>
    <input type="text" name="description" placeholder="Description" required>
    <input type="number" name="price" placeholder="Price" required>
    <input type="text" name="location" placeholder="Location" required>
    <select name="type">
        <option value="villa">Villa</option>
        <option value="apartment">Apartment</option>
        <option value="house">House</option>
        <option value="commercial">Commercial</option>
    </select>
    <input type="file" name="property_image" required>
    <button type="submit" name="submit">Add Property</button>
</form>
