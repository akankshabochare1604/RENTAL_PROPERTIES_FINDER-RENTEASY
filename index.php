<?php
include 'config/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Properties Finder</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="logo">
            <a href="index.php"><img src="images/logo.png" alt="Logo"></a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="users_area/signup.php">For Property Owners</a></li>
            <li><a href="users_area/login.php">Login</a></li>
            <li><a href="users_area/signup.php">Sign Up</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Menu</a>
                <div class="dropdown-content">
                    <a href="users_area/bookings.php">Bookings</a>
                    <a href="users_area/wishlist.php">Wishlist</a>
                </div>
            </li>
        </ul>
        <div class="search-bar">
            <form action="search.php" method="GET">
                <input type="text" placeholder="Search Properties..." name="query">
                <button type="submit">Search</button>
            </form>
        </div>
    </nav>

     

    <!-- Sidebar for Property Categories -->
    <div class="sidebar">
        <h3>Property Categories</h3>
        <ul>
            <li><a href="properties.php?category=villa">Villas</a></li>
            <li><a href="properties.php?category=apartment">Apartments</a></li>
            <li><a href="properties.php?category=house">Houses</a></li>
            <li><a href="properties.php?category=commercial">Commercial</a></li>
        </ul>
    </div>

    <!-- Property Cards Section -->
    <div class="properties-section">
        <h2>Featured Properties</h2>
        <div class="property-cards">
            <?php
            $sql = "SELECT * FROM properties LIMIT 6";
            $result = mysqli_query($conn, $sql);

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
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Rental Properties Finder. All rights reserved.</p>
    </footer>
</body>
</html>
