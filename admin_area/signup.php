<?php
session_start();
include '../config/db_connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
    $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
    $admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $admin_image = 'admin_img/default.png'; // Default profile image path

    // Check if the passwords match
    if ($admin_password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if the email already exists
        $sql_check_email = "SELECT * FROM admins WHERE admin_email = '$admin_email'";
        $result_check = mysqli_query($conn, $sql_check_email);

        if (mysqli_num_rows($result_check) > 0) {
            $error = "Email already exists!";
        } else {
            // Hash the password for security
            $hashed_password = password_hash($admin_password, PASSWORD_BCRYPT);

            // Insert the new admin into the database
            $sql_insert = "INSERT INTO admins (admin_name, admin_email, admin_password, admin_image) VALUES ('$admin_name', '$admin_email', '$hashed_password', '$admin_image')";

            if (mysqli_query($conn, $sql_insert)) {
                // Set session variables for the new admin
                $_SESSION['admin_id'] = mysqli_insert_id($conn);
                $_SESSION['admin_name'] = $admin_name;

                // Redirect to the admin dashboard
                header("Location: admin_dashboard.php");
                exit();
            } else {
                $error = "Error creating account. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <link rel="stylesheet" href="../styles/signup.css"> <!-- Link to the signup form's styling -->
</head>
<body>
    <div class="signup-form">
        <h2>Admin Signup</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="POST" action="">
            <label for="admin_name">Name:</label>
            <input type="text" name="admin_name" id="admin_name" required>
            
            <label for="admin_email">Email:</label>
            <input type="email" name="admin_email" id="admin_email" required>
            
            <label for="admin_password">Password:</label>
            <input type="password" name="admin_password" id="admin_password" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            
            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
