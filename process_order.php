<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST["item"];
    $quantity = $_POST["quantity"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];

    // Create a database connection
    $host = "localhost";  // Change this to your database host
    $username = "root";  // Change this to your database username
    $password = "";  // Change this to your database password
    $database = "data";  // Change this to your database name

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the order data into the database
    $sql = "INSERT INTO orders ( item, quantity,name, address,email) VALUES ('$item', $quantity, '$name', '$address','$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Order submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $conn->close();
} else {
    echo "Invalid request";
}
?>


