<?php
session_start();
include '../config/db_connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
    $admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']);
    
    // Fetch the admin details from the database
    $sql = "SELECT * FROM admins WHERE admin_email = '$admin_email'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) === 1) {
        $admin = mysqli_fetch_assoc($result);
        
        // Verify password
        if (password_verify($admin_password, $admin['admin_password'])) {
            // Set session variables
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_name'] = $admin['admin_name'];
            
            // Redirect to admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "No admin found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../styles/login.css"> <!-- Styling file for the login form -->
</head>
<body>
    <div class="login-form">
        <h2>Admin Login</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="POST" action="">
            <label for="admin_email">Email:</label>
            <input type="email" name="admin_email" id="admin_email" required>
            
            <label for="admin_password">Password:</label>
            <input type="password" name="admin_password" id="admin_password" required>
            
            <button type="submit">Login</button>
            <p>Dont have Account? <a href="signup.php">Signup</a>
        </form>
    </div>
</body>
</html>
