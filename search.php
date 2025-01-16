<?php
include 'config/db_connect.php';

if (isset($_GET['query'])) {
    $search_query = mysqli_real_escape_string($conn, $_GET['query']);
    $sql = "SELECT * FROM properties WHERE title LIKE '%$search_query%' OR description LIKE '%$search_query%'";
    $result = mysqli_query($conn, $sql);
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
    <title>Search Results</title>
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

    <h2>Search Results for '<?php echo htmlspecialchars($search_query); ?>'</h2>

    <div class="properties-section">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($property = mysqli_fetch_assoc($result)) {
                echo '
                    <div class="property-card">
                        <img src="property_images/' . $property['property_images'] . '" alt="Property Image">
                        <h3>' . $property['title'] . '</h3>
                        <p>' . $property['description'] . '</p>
                        <p>Price: $' . $property['price'] . '</p>
                        <a href="property_detail.php?id=' . $property['property_id'] . '" class="details-button">View Details</a>
                    </div>';
            }
        } else {
            echo '<p>No properties found matching your search.</p>';
        }
        ?>
    </div>
</body>
</html>
