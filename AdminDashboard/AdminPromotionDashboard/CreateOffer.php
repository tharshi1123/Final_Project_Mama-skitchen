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

// Initialize variables
$title = $description = $discount = $start_date = $end_date = "";
$titleErr = $descriptionErr = $discountErr = $dateErr = "";
$successMsg = $errorMsg = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Validate Title
if (empty($_POST['title'])) {
    $titleErr = "Title is required.";
} elseif (strlen($_POST['title']) > 100) {
    $titleErr = "Title cannot exceed 200 characters.";
} else {
    $title = trim($_POST['title']);
}

   // Validate Description
if (empty($_POST['description'])) {
    $descriptionErr = "Description is required.";
} else {
    $description = trim($_POST['description']);
    $wordCount = str_word_count($description); // Count words
    if ($wordCount > 200) {
        $descriptionErr = "Description cannot exceed 200 words.";
    }
}

    // Validate Discount
    if (empty($_POST['discount']) || !is_numeric($_POST['discount']) || $_POST['discount'] <= 0) {
        $discountErr = "Valid discount percentage is required.";
    } else {
        $discount = trim($_POST['discount']);
    }

    // Validate Dates
    if (empty($_POST['start_date']) || empty($_POST['end_date'])) {
        $dateErr = "Start date and end date are required.";
    } elseif ($_POST['start_date'] > $_POST['end_date']) {
        $dateErr = "Start date cannot be later than end date.";
    } else {
        $start_date = trim($_POST['start_date']);
        $end_date = trim($_POST['end_date']);
    }

    // If no errors, insert into database
    if (!$titleErr && !$descriptionErr && !$discountErr && !$dateErr) {
        $stmt = $conn->prepare("INSERT INTO promotions (title, description, discount, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $title, $description, $discount, $start_date, $end_date);

        if ($stmt->execute()) {
            $successMsg = "New promotion added successfully!";
            $title = $description = $discount = $start_date = $end_date = ""; // Clear form fields
        } else {
            $errorMsg = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mama's Kitchen - Add Promotion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Add New Promotion</h4>
                </div>
                <div class="card-body">
                    <!-- Display Success or Error Messages -->
                    <?php if ($successMsg): ?>
                        <div class="alert alert-success"><?php echo $successMsg; ?></div>
                    <?php endif; ?>
                    <?php if ($errorMsg): ?>
                        <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
                    <?php endif; ?>

                    <form id="promotionForm" action="" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="title" class="form-label">Promotion Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                            <div class="invalid-feedback">Title is required.</div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Promotion Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            <div class="invalid-feedback">Description is required.</div>
                        </div>

                        <div class="mb-3">
                            <label for="discount" class="form-label">Discount Percentage</label>
                            <input type="number" class="form-control" id="discount" name="discount" min="1" required>
                            <div class="invalid-feedback">Valid discount percentage is required.</div>
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                            <div class="invalid-feedback">Start date is required.</div>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                            <div class="invalid-feedback">End date is required.</div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Add Promotion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Bootstrap form validation
    const form = document.getElementById("promotionForm");

    form.addEventListener("submit", function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        form.classList.add("was-validated");
    });

    // Additional validation for date range
    document.getElementById("end_date").addEventListener("change", function () {
        let startDate = document.getElementById("start_date").value;
        let endDate = this.value;

        if (startDate && endDate && startDate > endDate) {
            this.setCustomValidity("End date must be later than start date.");
        } else {
            this.setCustomValidity("");
        }
    });

    document.getElementById("start_date").addEventListener("change", function () {
        document.getElementById("end_date").setCustomValidity(""); // Reset validation message
    });
});
</script>

</body>
</html>
