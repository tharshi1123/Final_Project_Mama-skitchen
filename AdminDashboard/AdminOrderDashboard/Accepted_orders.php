<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "data");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM accepted_orders";
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
    <title>Accepted Orders</title>
</head>

<style>
   th,tbody {
    font-size: 10px;
}

.table td, .table th {
    padding: .40rem;
}

h2{
    color: #522258;
    font-size: 15px;
}
</style>

<body>

<div class="container my-5">
    <h2 class="text-Left mb-4">Accepted Orders</h2>
    <div class="table-responsive">
        <table class="table table-striped align-middle text-left">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cardholder Name</th>
                    <th scope="col">Expiry Date</th>
                    <th scope="col">CVV</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr><td>' . $row["id"] . '</td><td>'
                        . $row["item"] . '</td><td>'
                        . $row["quantity"] . '</td><td>'
                        . $row["name"] . '</td><td>'
                        . $row["address"] . '</td><td>'
                        . $row["total_amount"] . '</td><td>'
                        . $row["email"] . '</td><td>'
                        . $row["accepted_at"] . '</td></tr>';
                }
            } else {
                echo '<tr><td colspan="10" class="text-center">No accepted orders found</td></tr>';
            }
            ?>
        </tbody>
        </table>
    </div>
</div>
    <script src="assets/js/jquery-2.1.0.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
