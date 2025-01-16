<?php
include '../config/db_connect.php';
session_start();

// Assuming admin is logged in, fetch their profile details using their session ID
$admin_id = $_SESSION['admin_id'];

// Fetch admin details
$sql = "SELECT * FROM admins WHERE admin_id = '$admin_id'";
$result = mysqli_query($conn, $sql);
$admin = mysqli_fetch_assoc($result);

// Update profile
if (isset($_POST['update_profile'])) {
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_contact_no = $_POST['admin_contact_no']; // Updated to match the database

    // Handle profile image update
    if ($_FILES['admin_image']['name']) {
        $admin_image = $_FILES['admin_image']['name'];
        $image_tmp = $_FILES['admin_image']['tmp_name'];
        $image_folder = "../admin_img/" . $admin_image;

        // Move the uploaded image to the specified folder
        if (move_uploaded_file($image_tmp, $image_folder)) {
            // Update image path in the database
            $sql_image = "UPDATE admins SET admin_image = '$admin_image' WHERE admin_id = '$admin_id'";
            mysqli_query($conn, $sql_image);
        } else {
            echo "Failed to upload image.";
        }
    }

    // Update other profile details
    $sql_update = "UPDATE admins SET admin_name = '$admin_name', admin_email = '$admin_email', admin_contact_no = '$admin_contact_no' 
                   WHERE admin_id = '$admin_id'";
    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Profile updated successfully');</script>";

    } else {
        echo "<script>alert('Error updating profile:');</script " . mysqli_error($conn);
    }
}

// Update password
if (isset($_POST['update_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if current password matches
    if (password_verify($current_password, $admin['admin_password'])) {
        // Check if new passwords match
        if ($new_password === $confirm_password) {
            // Hash the new password and update it in the database
            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
            $sql_password = "UPDATE admins SET admin_password = '$new_password_hashed' WHERE admin_id = '$admin_id'";
            if (mysqli_query($conn, $sql_password)) {
                echo "Password updated successfully";
            } else {
                echo "Error updating password: " . mysqli_error($conn);
            }
        } else {
            echo "New passwords do not match!";
        }
    } else {
        echo "Current password is incorrect!";
    }
}

// Delete profile
if (isset($_POST['delete_profile'])) {
    $sql_delete = "DELETE FROM admins WHERE admin_id = '$admin_id'";
    if (mysqli_query($conn, $sql_delete)) {
        session_destroy();
        header("Location: logout.php"); // Redirect to logout after profile deletion
    } else {
        echo "Error deleting profile: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/admin_profile.css"> <!-- Link to your CSS file -->
    <title>Admin Profile</title>
</head>
<body>
    <div class="profile-container">
        <h2>Admin Profile</h2>
        <img src="../admin_img/<?php echo $admin['admin_image']; ?>" alt="Admin Image" style="width:100px;height:100px;"><br>
        <form method="POST" enctype="multipart/form-data">
            <label>Name:</label>
            <input type="text" name="admin_name" value="<?php echo $admin['admin_name']; ?>" required><br>

            <label>Email:</label>
            <input type="email" name="admin_email" value="<?php echo $admin['admin_email']; ?>" required><br>

            <label>Contact Number:</label>
            <input type="text" name="admin_contact_no" value="<?php echo $admin['admin_contact_no']; ?>" required><br>

            <label>Profile Image:</label>
            <input type="file" name="admin_image"><br>

            <button type="submit" name="update_profile">Update Profile</button>
        </form>

        <!-- Form to Update Password -->
        <h2>Change Password</h2>
        <form method="POST">
            <label>Current Password:</label>
            <input type="password" name="current_password" required><br>

            <label>New Password:</label>
            <input type="password" name="new_password" required><br>

            <label>Confirm New Password:</label>
            <input type="password" name="confirm_password" required><br>

            <button type="submit" name="update_password">Update Password</button>
        </form>

        <!-- Form to Delete Profile -->
        <h2>Delete Profile</h2>
        <form method="POST">
            <button type="submit" name="delete_profile" onclick="return confirm('Are you sure you want to delete your profile?');">Delete Profile</button>
        </form>
    </div>
</body>
</html>
