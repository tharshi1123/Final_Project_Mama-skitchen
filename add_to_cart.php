<?php
session_start();

$itemName = $_GET['name'];
$itemPrice = $_GET['price'];
$itemImage = $_GET['image'];
$quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1;

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$cart = $_SESSION['cart'];

if (isset($cart[$itemName])) {
    // Increase quantity if item already exists in cart
    $cart[$itemName]['quantity'] += $quantity;
} else {
    // Add new item to cart
    $cart[$itemName] = array(
        'price' => $itemPrice,
        'image' => $itemImage,
        'quantity' => $quantity
    );
}

$_SESSION['cart'] = $cart;

header('Location: Order.php'); // Redirect to the order page or cart page
?>
