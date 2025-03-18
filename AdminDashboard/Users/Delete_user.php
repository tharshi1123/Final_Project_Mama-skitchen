<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $userId = $_POST['user_id'];

    $conn = mysqli_connect("localhost", "root", "", "data");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete user from the database
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);

    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully');window.location.href='Users.php';</script>";
    } else {
        echo "<script>alert('Error deleting user: " . $stmt->error . "');window.location.href='your_previous_page.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request');window.location.href='your_previous_page.php';</script>";
}
?>
