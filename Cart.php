<?php
session_start();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $itemName = $_GET['name'];
    
    if ($action == 'update' && isset($_GET['quantity'])) {
        $quantity = (int)$_GET['quantity'];
        if (isset($_SESSION['cart'][$itemName])) {
            $_SESSION['cart'][$itemName]['quantity'] = $quantity;
        }
    } elseif ($action == 'delete') {
        if (isset($_SESSION['cart'][$itemName])) {
            unset($_SESSION['cart'][$itemName]);
        }
    }

    header('Location: cart.php'); // Redirect to the cart page to reflect changes
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .add-more-button, .payment-section {
            margin-top: 20px;
        }
        .add-more-button a button, .payment-section button {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .add-more-button a button:hover, .payment-section button:hover {
            background-color: #218838;
        }
        .quantity-buttons a {
            margin: 0 5px;
            color: #007bff;
            text-decoration: none;
        }
        .quantity-buttons a:hover {
            text-decoration: underline;
        }
        .total-amount {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php include 'Navbar.php'; ?>

    <section class="section">
        <div class="container">
            <h2>Your Cart</h2>
            <?php
            $totalAmount = 0;
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];
                echo '<table class="table">';
                echo '<thead><tr><th>Item</th><th>Image</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr></thead>';
                echo '<tbody>';
                foreach ($cart as $itemName => $item) {
                    $itemTotal = $item['price'] * $item['quantity'];
                    $totalAmount += $itemTotal;
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($itemName) . '</td>';
                    echo '<td><img src="' . htmlspecialchars($item['image']) . '" style="height: 100px;" alt=""></td>';
                    echo '<td>RS ' . htmlspecialchars($item['price']) . '</td>';
                    echo '<td>' . htmlspecialchars($item['quantity']) . '</td>';
                    echo '<td>RS ' . htmlspecialchars($itemTotal) . '</td>';
                    echo '<td class="quantity-buttons">
                        <a href="cart.php?action=update&name=' . urlencode($itemName) . '&quantity=' . ($item['quantity'] + 1) . '">+</a> |
                        <a href="cart.php?action=update&name=' . urlencode($itemName) . '&quantity=' . max($item['quantity'] - 1, 1) . '">-</a> |
                        <a href="cart.php?action=delete&name=' . urlencode($itemName) . '">Delete</a>
                    </td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '<div class="total-amount">Total Amount: RS ' . number_format($totalAmount, 2) . '</div>';
            } else {
                echo '<p>Your cart is empty.</p>';
            }
            ?>
            <div class="add-more-button">
                <a href="menu.php"><button>Add More Items</button></a>
            </div>
            <div class="payment-section">
                <form action="process_payment.php" method="post">
                    <button type="submit">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </section>

    <?php include 'Footer.php'; ?>

    <script src="assets/js/jquery-2.1.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
