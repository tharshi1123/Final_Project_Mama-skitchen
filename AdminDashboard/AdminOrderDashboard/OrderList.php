<?php
// Include the necessary PHPMailer classes
require 'C:\xampp\htdocs\Mamas kitchen\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\Mamas kitchen\PHPMailer\src\SMTP.php';
require 'C:\xampp\htdocs\Mamas kitchen\PHPMailer\src\Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database connection
$conn = mysqli_connect("localhost", "root", "", "data");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $orderId = $_POST['order_id'];
    $action = $_POST['action'];

    if ($action === 'accept') {
        // Fetch order details from the database
        $sql = "SELECT * FROM order_details WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();

        if ($order) {
            // Send email using PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'tharshika.balachandran98@gmail.com'; // Replace with your SMTP username
                $mail->Password = 'xzlbjqfdgdwxmdxn'; // Replace with your SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('tharshika.balachandran98@gmail.com', 'ABC Restaurant');
                $mail->addAddress($order['email'], $order['cardholder_name']); // Send email to the customer

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Your Order Bill';
                $mail->Body = '
                <html>
                <head>
                  
                </head>
                <body>
               
                    <div class="card">
                        <div class="card-header">Order Confirmation</div>
                        <div class="card-body">
                            <p>Dear ' . htmlspecialchars($order['cardholder_name']) . ',</p>
                            <p>Your order with ID #' . htmlspecialchars($order['id']) . ' has been accepted.</p>
                            <table class="table table-bordered">
                            <tbody>
                                <tr><th>ID</th><td>' . htmlspecialchars($order['id']) . '</td></tr>
                                <tr><th>Item</th><td>' . htmlspecialchars($order['item_names']) . '</td></tr>
                                <tr><th>Quantity</th><td>' . htmlspecialchars($order['quantity']) . '</td></tr>
                                <tr><th>Total Amount</th><td>' . htmlspecialchars($order['total_amount']) . '</td></tr>
                                <tr><th>Address</th><td>' . htmlspecialchars($order['delivery_address']) . '</td></tr>
                           </tbody>
                                </table>
                        </div>
                        
                        <div class="card-footer">
                            Thank you for shopping with us!
                        </div>
                    </div>
                    
                </body>
                </html>';
                $mail->AltBody = 'Dear ' . htmlspecialchars($order['cardholder_name']) . ', Your order with ID #' . htmlspecialchars($order['id']) . ' has been accepted. Thank you for shopping with us!';

                $mail->send();

                // Move order to accepted_orders table
                $insertSql = "INSERT INTO accepted_orders (item, quantity, name, address, total_amount, email) VALUES (?, ?, ?, ?, ?, ?)";
                $insertStmt = $conn->prepare($insertSql);
                $insertStmt->bind_param('sissis', $order['item_names'], $order['quantity'], $order['cardholder_name'], $order['delivery_address'], $order['total_amount'], $order['email']);
                $insertStmt->execute();

                // Delete order from orders table
                $deleteSql = "DELETE FROM order_details WHERE id = ?";
                $deleteStmt = $conn->prepare($deleteSql);
                $deleteStmt->bind_param('i', $orderId);
                $deleteStmt->execute();

                echo "<script type='text/javascript'>alert('Email sent and order moved successfully'); window.location.href='order_list.php';</script>";
            } catch (Exception $e) {
                echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Order List</title>
</head>
<style>
th,tbody {
    font-size: 10px;
}

.table td, .table th {
    padding: .40rem;
}

h2{
    color: #522258;
    font-size: 15px;
}
    </style>
<body>
<div class="container my-5">
    <h2 class="text-Left mb-4">All Orders</h2>
    <div class="table-responsive">
        <table class="table table-striped align-middle text-left">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Cardholder Name</th>
                    <th scope="col">Expiry Date</th>
                    <th scope="col">CVV</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM order_details";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr><td>' . htmlspecialchars($row["id"]) . '</td><td>'
                    . htmlspecialchars($row["item_names"]) . '</td><td>'
                        . htmlspecialchars($row["cardholder_name"]) . '</td><td>'
                        . htmlspecialchars($row["expiry_date"]) . '</td><td>'
                        . htmlspecialchars($row["cvv"]) . '</td><td>'
                        . htmlspecialchars($row["total_amount"]) . '</td><td>'
                        . htmlspecialchars($row["quantity"]) . '</td><td>'
                        
                        . htmlspecialchars($row["delivery_address"]) . '</td><td>'
                        . htmlspecialchars($row["email"]) . '</td><td>'
                         . htmlspecialchars($row["contact_number"]) . '</td><td>'
                        . '<form method="post" action="" style="display:inline;">
                            <input type="hidden" name="order_id" value="' . htmlspecialchars($row["id"]) . '">
                            <button type="submit" name="action" value="accept" class="btn btn-success btn-sm">Accept</button>
                          </form>'
                        . '</td></tr>';
                }
            } else {
                echo '<tr><td colspan="10" class="text-center">No order details found</td></tr>';
            }
            ?>
        </tbody>
        </table>
    </div>
</div>

    <script src="assets/js/jquery-2.1.0.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
