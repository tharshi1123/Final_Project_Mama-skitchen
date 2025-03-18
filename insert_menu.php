<?php
// Database connection
$servername = "localhost"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "data"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menu items array (this would ideally come from your form or elsewhere)
$menu_items = [
    [
        'name' => 'Mozzarella Sticks',
        'description' => 'Golden-fried mozzarella cheese sticks served with a zesty marinara dipping sauce.',
        'price' => 1000,
        'image_url' => 'assets/images/Homemade-Mozzarella-Sticks-9 (1).jpeg'
    ],
    [
        'name' => 'Spinach Artichoke Dip',
        'description' => 'Creamy blend of spinach, artichokes, and melted cheese, served with warm tortilla chips.',
        'price' => 700,
        'image_url' => 'assets/images/220602_DD_Spinach-Artichoke-Dip_140-1.jpg'
    ],
    [
        'name' => 'Caesar Salad',
        'description' => 'Fresh romaine lettuce, parmesan cheese, croutons, and our homemade Caesar dressing.',
        'price' => 700,
        'image_url' => 'assets/images/product-3-720x480.jpg'
    ],
    [
        'name' => 'Caprese Salad',
        'description' => 'Sliced tomatoes, fresh mozzarella, basil leaves, drizzled with balsamic glaze and olive oil.',
        'price' => 900,
        'image_url' => 'assets/images/product-4-720x480.jpg'
    ],
    [
        'name' => 'Classic Cheeseburger',
        'description' => 'A juicy beef patty topped with cheddar cheese, lettuce, tomato, onion, and served with hand-cut fries.',
        'price' => 1700,
        'image_url' => 'assets/images/product-5-720x480.jpg'
    ],
    [
        'name' => 'Grilled Salmon',
        'description' => 'Fresh Atlantic salmon fillet seasoned and grilled to perfection, served with a lemon butter sauce and choice of two sides.',
        'price' => 1400,
        'image_url' => 'assets/images/product-6-720x480.jpg'
    ]
];

// Insert menu items into the database
foreach ($menu_items as $item) {
    $name = $item['name'];
    $description = $item['description'];
    $price = $item['price'];
    $image_url = $item['image_url'];

    $sql = "INSERT INTO menu_items (name, description, price, image_url) VALUES ('$name', '$description', $price, '$image_url')";

    if ($conn->query($sql) === TRUE) {
        echo "Menu item '$name' inserted successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
