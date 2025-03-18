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

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $username_to_delete = $_POST['username'];

    // SQL query to delete the user from the database
    $delete_sql = "DELETE FROM adminusers WHERE username = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("s", $username_to_delete);

    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    $stmt->close();
}

// SQL query to retrieve admin user data from the database
$sql = "SELECT username, userRole, password, email FROM adminusers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin User List</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 28px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #2c3e50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .delete-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
        }
        .delete-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <h2>Admin User List</h2>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>User Role</th>
                <th>Password</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row in table rows
                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["username"] . '</td>';
                    echo '<td>' . $row["userRole"] . '</td>';
                    echo '<td>' . $row["password"] . '</td>';
                    echo '<td>' . $row["email"] . '</td>';
                    echo '<td>';
                    echo '<form method="POST" action="">';
                    echo '<input type="hidden" name="username" value="' . $row["username"] . '">';
                    echo '<input type="submit" name="delete_user" value="Delete" class="delete-btn">';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5">No users found.</td></tr>';
            }
            // Close the connection
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
