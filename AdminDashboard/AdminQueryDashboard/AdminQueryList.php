
<?php

// Database connection
$conn = new mysqli('localhost', 'root', '', 'data'); // Update with your database credentials
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch inquiries
$sql = "SELECT * FROM inquiries ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>ABC RESTAURANT</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Admin Dashboard</title>
    <style>
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-4">Inquiries Dashboard</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['subject']); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($row['name']); ?> - <?php echo htmlspecialchars($row['email']); ?></h6>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
                        <footer class="blockquote-footer"><?php echo $row['created_at']; ?></footer>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#replyModal<?php echo $row['id']; ?>">
                            Reply
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="replyModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="replyModalLabel">Reply to Inquiry</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="reply_inquiry.php" method="post">
                                            <input type="hidden" name="inquiry_id" value="<?php echo $row['id']; ?>">
                                            <div class="form-group">
                                                <label for="replyMessage">Your Reply:</label>
                                                <textarea class="form-control" id="replyMessage" name="reply_message" rows="5" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Send Reply</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No inquiries found.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
