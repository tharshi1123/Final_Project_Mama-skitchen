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
$sql = "SELECT title, description, discount, start_date, end_date FROM promotions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>ABC RESTAURANT</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">
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
    </style>
</head>
<body>

   
    <!-- ***** Header Area Start ***** -->
    <?php include 'Navbar.php'; ?>
    <!-- ***** Header Area End ***** -->

    <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>Our <em>Menu</em></h2>
                    </div>
                </div>
    <div class="card-container">
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<h3>' . $row["title"] . '</h3>';
                echo '<p>' . $row["description"] . '</p>';
                echo '<p class="discount">Discount: ' . $row["discount"] . '%</p>';
                echo '<p>Start Date: ' . $row["start_date"] . '</p>';
                echo '<p>End Date: ' . $row["end_date"] . '</p>';
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
