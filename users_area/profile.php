<?php
include '../config/db_connect.php';
session_start();
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];

    if ($_FILES['profile_image']['name']) {
        $profile_image = $_FILES['profile_image']['name'];
        $image_tmp = $_FILES['profile_image']['tmp_name'];
        $image_folder = "../user_img/" . $profile_image;
        move_uploaded_file($image_tmp, $image_folder);

        $sql_image = "UPDATE users SET profile_image = '$profile_image' WHERE user_id = '$user_id'";
        mysqli_query($conn, $sql_image);
    }

    $sql_update = "UPDATE users SET name = '$name', email = '$email', contact_no = '$contact_no' WHERE user_id = '$user_id'";
    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Profile updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating profile: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/user_profile.css">
    <title>User Profile</title>
</head>
<body>
    <h2>Profile</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br>

        <label>Contact Number:</label>
        <input type="text" name="contact_no" value="<?php echo $user['contact_no']; ?>" required><br>

        <label>Profile Image:</label>
        <input type="file" name="profile_image"><br>
        <img src="../user_img/<?php echo $user['profile_image']; ?>" alt="Profile Image" style="width:100px;height:100px;"><br>

        <button type="submit" name="update_profile">Update Profile</button>
    </form>
</body>
</html>
