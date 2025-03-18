<?php
// Database configuration
$host = 'localhost';
$username = 'root'; // Update with your database username
$password = ''; // Update with your database password
$database = 'data'; // Update with your database name

// Create a database connection
$conn = mysqli_connect("localhost", "root", "", "data");


// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    // Prepare the SQL query
    $sql = "INSERT INTO inquiries (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Inquiry submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
