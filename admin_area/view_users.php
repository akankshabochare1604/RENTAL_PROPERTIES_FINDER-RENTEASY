<?php
// Include database connection
include '../config/db_connect.php';

// Fetch users from the database
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="stylesheet" href="../styles/admin_profile.css">
</head>
<body>
    <div class="container">
        <h1>View Users</h1>

        <table class="users-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($user = mysqli_fetch_assoc($result)) {
                        echo '
                        <tr>
                            <td>' . $user['user_id'] . '</td>
                            <td>' . $user['name'] . '</td>
                            <td>' . $user['email'] . '</td>
                            <td>' . ucfirst($user['role']) . '</td>
                            <td>
                                <a href="edit_user.php?id=' . $user['user_id'] . '" class="btn-edit">Edit</a>
                                <a href="delete_user.php?id=' . $user['user_id'] . '" class="btn-delete" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</a>
                            </td>
                        </tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">No users found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
