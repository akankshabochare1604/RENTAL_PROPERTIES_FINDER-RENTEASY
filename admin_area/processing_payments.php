<?php
// Include database connection
include '../config/db_connect.php';

// Fetch processing payments from the database
$sql = "SELECT p.payment_id, u.name AS user_name, pr.title AS property_title, p.amount, p.payment_method, p.payment_date, p.status 
        FROM payments p
        JOIN users u ON p.user_id = u.user_id
        JOIN properties pr ON p.property_id = pr.property_id
        WHERE p.status = 'processing'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Processing Payments</title>
    <link rel="stylesheet" href="../styles/admin_profile.css">
</head>
<body>
    <div class="container">
        <h1>View Processing Payments</h1>

        <table class="payments-table">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>User Name</th>
                    <th>Property Title</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Payment Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($payment = mysqli_fetch_assoc($result)) {
                        echo '
                        <tr>
                            <td>' . $payment['payment_id'] . '</td>
                            <td>' . $payment['user_name'] . '</td>
                            <td>' . $payment['property_title'] . '</td>
                            <td>' . $payment['amount'] . '</td>
                            <td>' . ucfirst($payment['payment_method']) . '</td>
                            <td>' . $payment['payment_date'] . '</td>
                            <td>' . ucfirst($payment['status']) . '</td>
                        </tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">No processing payments found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
