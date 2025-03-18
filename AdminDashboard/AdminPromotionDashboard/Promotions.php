<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve promotion data from the database
$sql = "SELECT id, title, description, discount, start_date, end_date FROM promotions";
$result = $conn->query($sql);

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idToDelete = $_POST['id'];

    // SQL query to delete the selected promotion
    $deleteSql = "DELETE FROM promotions WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $idToDelete);

    if ($stmt->execute()) {
        echo "Promotion deleted successfully.";
    } else {
        echo "Error deleting promotion: " . $conn->error;
    }
    $stmt->close();

    // Refresh the page to show updated list
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotion Cards</title>
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }
        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .card h3 {
            margin-top: 0;
            color: #333;
        }
        .card p {
            margin: 5px 0;
            color: #555;
        }
        .card .discount {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
        }
        .delete-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h2>Current Promotions</h2>
    <div class="card-container">
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';
                echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
                echo '<p class="discount">Discount: ' . htmlspecialchars($row["discount"]) . '%</p>';
                echo '<p>Start Date: ' . htmlspecialchars($row["start_date"]) . '</p>';
                echo '<p>End Date: ' . htmlspecialchars($row["end_date"]) . '</p>';
                echo '<form method="POST" action="" onsubmit="return confirm(\'Are you sure you want to delete this promotion?\');">';
                echo '<input type="hidden" name="id" value="' . htmlspecialchars($row["id"]) . '">';
                echo '<button type="submit" class="delete-button">Delete</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo '<p>No promotions found.</p>';
        }
        // Close the connection
        $conn->close();
        ?>
    </div>
</body>
</html>
