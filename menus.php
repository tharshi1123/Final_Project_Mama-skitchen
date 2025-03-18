<?php
// menu.php (or whatever you name the file)

// Database connection (same as your addmenu.php)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to display a menu card (same as before)
function display_menu_card($row) {
    echo "<div class='card' style='border: 1px solid #ccc; border-radius: 8px; padding: 15px; width: 200px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1); margin-bottom: 20px;'>";
    echo "<img src='" . $row["image"] . "' alt='" . htmlspecialchars($row["name"]) . "' style='width: 100%; height: auto;'><br>";
    echo "<h3>" . htmlspecialchars($row["name"]) . "</h3>";
    echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
    echo "<p>Price: RS " . $row["price"] . "</p>";
    echo "</div>";
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Menu</title>
<style>
    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .card img {
        max-width: 100%;
        height: auto;
    }
</style>
</head>
<body>

<h1>Our Menu</h1>

<div class="card-container">
    <?php
    $result = $conn->query("SELECT * FROM menu");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            display_menu_card($row);
        }
    } else {
        echo "<p>No menu items yet.</p>";
    }
    $conn->close(); // Close the connection after use
    ?>
</div>

</body>
</html>