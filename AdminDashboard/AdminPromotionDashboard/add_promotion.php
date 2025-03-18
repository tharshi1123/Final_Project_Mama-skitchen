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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $discount = $conn->real_escape_string($_POST['discount']);
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date = $conn->real_escape_string($_POST['end_date']);

   
    // SQL query to insert promotion data into the database
    $sql = "INSERT INTO promotions (title, description, discount, start_date, end_date) VALUES ('$title', '$description', '$discount', '$start_date', '$end_date')";

    if ($conn->query($sql) === TRUE) {
        echo "New promotion added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
