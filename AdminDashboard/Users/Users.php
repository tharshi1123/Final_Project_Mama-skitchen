<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    <title>Signature Cuisine</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
       

        table {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 40px;
        }

        th {
            background-color: #343a40;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        td {
            padding: 12px 15px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        thead th, tbody td {
            text-align: center;
        }

        footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4">List of Login Customers</h2>
        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "data");
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>"
                . $row["username"] . "</td><td>"
                . $row["email"] . "</td><td>"
                . $row["password"] . "</td><td>"
                . '<form method="post" action="Delete_user.php" style="display:inline;">'
                . '<input type="hidden" name="user_id" value="' . $row["id"] . '">'
                . '<button type="submit" name="delete" class="btn btn-danger">Delete</button>'
                . '</form>'
                . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No results found</td></tr>";
    }
    $conn->close();
    ?>
</tbody>

        </table>
    </div>

 

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/custom.js"></script>
</body>

</html>
