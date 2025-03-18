<?php
$conn = mysqli_connect("localhost", "root", "", "data");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $orderId = $_POST['order_id'];
    $action = $_POST['action'];

    // Fetch order details from the database
    $sql = "SELECT * FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();

    if ($order && $action === 'accept') {
        // Move the order to another file (e.g., acceptedOrders.php)
        // You could also insert the accepted orders into another table for tracking.

        // Redirect to another page, passing the order ID
        header('Location: acceptedOrders.php?order_id=' . $orderId);
        exit();
    } elseif ($action === 'decline') {
        // Handle decline logic here
    }
}
?>
