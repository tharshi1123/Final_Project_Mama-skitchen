<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "data");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the delete button is clicked and handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $conn->real_escape_string($_GET['delete_id']);
    
    // Delete query
    $deleteSql = "DELETE FROM replies WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param('i', $delete_id);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Reply deleted successfully!'); window.location.href = 'RepliedQuery.php';</script>";
    } else {
        echo "<script>alert('Failed to delete the reply.'); window.location.href = 'RepliedQuery.php';</script>";
    }

    $stmt->close();
}

// Fetch replies
$sql = "SELECT * FROM replies";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>ABC restaurant</title>
</head>

<style>
    /* Center the table and add margin */
    .table {
        width: 100%;
        margin: 20px auto;
        border-collapse: collapse;
    }

    /* Style table headers */
    .table thead th {
        background-color: #f8f9fa; /* Light gray background for headers */
        color: #343a40; /* Dark gray text color */
        padding: 10px;
        border-bottom: 2px solid #dee2e6; /* Darker bottom border */
        text-align: left;
    }

    /* Style table cells */
    .table tbody td {
        background-color: #ffffff; /* White background for cells */
        color: #495057; /* Darker gray text color */
        padding: 10px;
        border-bottom: 1px solid #dee2e6; /* Light gray border for rows */
    }

    /* Alternate row colors */
    .table tbody tr:nth-child(odd) {
        background-color: #f9f9f9; /* Light gray background for odd rows */
    }

    .table tbody tr:hover {
        background-color: #e9ecef; /* Slightly darker gray on hover */
    }

    /* Style for empty rows message */
    .table tbody td.text-center {
        text-align: center;
        color: #6c757d; /* Light gray color for text */
        padding: 20px; /* More padding for the message */
    }

    /* Add table borders */
    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th, .table-bordered td {
        border: 1px solid #dee2e6;
    }

    /* Add some padding for the delete button */
    .delete-btn {
        padding: 5px 10px;
        color: #fff;
        background-color: #dc3545;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        text-decoration: none;
    }
</style>

<body>
    <h2 class="text-center mb-4">Replies for quaries</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Inquiry ID</th>
                <th>Reply Message</th>
                <th>Time</th>
                <th>Action</th> <!-- Column for delete button -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>
                        <td>' . $row["inquiry_id"] . '</td>
                        <td>' . $row["reply_message"] . '</td>
                        <td>' . $row["created_at"] . '</td>
                        <td><a href="?delete_id=' . $row["id"] . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this reply?\')">Delete</a></td>
                      </tr>';
                }
            } else {
                echo '<tr><td colspan="4" class="text-center">No replies found</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <script src="assets/js/jquery-2.1.0.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
