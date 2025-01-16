<?php
include '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $contact_no = $_POST['contact_no'];
    $role = $_POST['role'];

    // Check if email already exists
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists!');</script>";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (name, email, password, contact_no, role) 
                VALUES ('$name', '$email', '$password', '$contact_no', '$role')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Signup successful!'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Error during signup: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/user_profile.css">
    <title>User Signup</title>
</head>
<body>
    <h2>Signup</h2>
    <form method="POST" action="signup.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="contact_no">Contact Number:</label>
        <input type="text" id="contact_no" name="contact_no" required><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="tenant">Tenant</option>
            <option value="owner">Owner</option>
        </select><br>

        <button type="submit">Signup</button>
    </form>
</body>
</html>
