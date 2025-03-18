<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "data");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch order item counts
$sql = "SELECT item,quantity, COUNT(*) as count FROM accepted_orders GROUP BY item";
$result = $conn->query($sql);

$items = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
    $items[] = $row['item'];
    $counts[] = $row['quantity'];
}

// Encode data as JSON for use in JavaScript
$itemsJson = json_encode($items);
$countsJson = json_encode($counts);

$conn->close();
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
    <title>Order Distribution</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .small-chart {
            width: 300px; /* Set the width of the chart */
            height: 300px; /* Set the height of the chart */
            max-width: 100%; /* Ensure it scales down on smaller screens */
            margin: 0 auto; /* Center the chart */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Order Distribution by Item</h2>
        <canvas id="orderChart" class="small-chart"></canvas>
    </div>

    <script>
        // Create pie chart
        var ctx = document.getElementById('orderChart').getContext('2d');
        var orderChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo $itemsJson; ?>,
                datasets: [{
                    data: <?php echo $countsJson; ?>,
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40'
                    ],
                    hoverBackgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
