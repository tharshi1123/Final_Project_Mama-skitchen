<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Payment Successful!</h2>
        <p>Thank you for your order. Your payment has been processed successfully.</p>
        <a href="menu.php" class="btn btn-primary">Back to Menu</a>
    </div>
</body>

</html>

<?php
require 'vendor/autoload.php'; // For Stripe (if needed)
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "data"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cardholderName = $_POST['cardholder_name'];
$expiryDate = $_POST['expiry_date'];
$cvv = $_POST['cvv'];
$totalAmount = $_POST['total_amount'];
$quantity = $_POST['quantity'];
$email = $_POST['email']; // New field
$contactNumber = $_POST['contact_number']; // New field
$deliveryAddress = $_POST['delivery_address']; // New field

// Insert into order_details table
$stmt = $conn->prepare("INSERT INTO order_details (cardholder_name, expiry_date, cvv, total_amount, quantity, email,contact_number, delivery_address) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
$stmt->bind_param("ssssisis", $cardholderName, $expiryDate, $cvv, $totalAmount, $quantity, $email,$contactNumber, $deliveryAddress);

if ($stmt->execute()) {
    $orderId = $stmt->insert_id; // Get the ID of the newly inserted order

    // Insert into order_items table
    $itemStmt = $conn->prepare("INSERT INTO order_items (order_id, item_name) VALUES (?, ?)");
    
    // Collect item names
    $itemNames = [];
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'item_name_') === 0) {
            $itemNames[] = $value;
            $itemStmt->bind_param("is", $orderId, $value);
            $itemStmt->execute();
        }
    }

    // Optionally clear the cart
    unset($_SESSION['cart']);

    // Update order_details with concatenated item names
    $itemNamesString = implode(', ', $itemNames);
    $updateStmt = $conn->prepare("UPDATE order_details SET item_names = ? WHERE id = ?");
    $updateStmt->bind_param("si", $itemNamesString, $orderId);
    $updateStmt->execute();

    echo "<script>alert('Order placed successfully!');</script>";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$itemStmt->close();
$updateStmt->close();
$conn->close();
?>
