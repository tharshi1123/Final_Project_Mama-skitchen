<?php
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "data"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch offers from the database
$sql = "SELECT id, title, description, image, created_at FROM offers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Available Offers</h1>";
    echo "<div style='display: flex; flex-wrap: wrap;'>";

    while ($row = $result->fetch_assoc()) {
        $imageData = base64_encode($row['image']); // Encode image data as base64
        $imageSrc = "data:image/jpeg;base64," . $imageData; // Change mime type if necessary

        echo "<div style='border: 1px solid #ddd; margin: 10px; padding: 10px; width: 300px;'>";
        echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
        echo "<img src='" . $imageSrc . "' alt='" . htmlspecialchars($row['title']) . "' width='100%' height='auto'>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        echo "<p><small>Created on: " . $row['created_at'] . "</small></p>";
        echo "</div>";
    }

    echo "</div>";
} else {
    echo "No offers found.";
}

// Close connection
$conn->close();
?>
