<?php
include 'config/db_connect.php';

if (isset($_GET['id'])) {
    $property_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM properties WHERE property_id = '$property_id'";
    $result = mysqli_query($conn, $sql);
    $property = mysqli_fetch_assoc($result);

    if (!$property) {
        echo "Property not found!";
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $property['title']; ?></title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <nav>
        <div class="logo">
            <a href="index.php"><img src="images/logo.png" alt="Logo"></a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <!-- Other navbar links here -->
        </ul>
    </nav>

    <div class="property-detail">
        <img src="property_images/<?php echo $property['property_images']; ?>" alt="Property Image">
        <h2><?php echo $property['title']; ?></h2>
        <p><?php echo $property['description']; ?></p>
        <p>Price: $<?php echo $property['price']; ?></p>
        <p>Location: <?php echo $property['location']; ?></p>
    </div>
</body>
</html>
