<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Recommendation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .food-card {
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }
        .food-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            padding-top: 2rem;
            padding-bottom: 4rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Find Perfect Meal Recommendations</h2>
        
        <div class="card p-4 mb-5 shadow-sm">
            <form method="POST" action="" class="row g-3">
                <div class="col-12">
                    <label for="calories" class="form-label">Enter Your Calories</label>
                    <div class="input-group">
                        <input type="number" 
                               class="form-control form-control-lg" 
                               id="calories" 
                               name="calories" 
                               placeholder="e.g., 300" 
                               required>
                        <button type="submit" class="btn btn-primary btn-lg">
                            Get Food Recommendations 
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $calories = $_POST["calories"];
            $api_url = "http://127.0.0.1:5000/recommend?calories=" . urlencode($calories);
            
            $response = file_get_contents($api_url);
            $data = json_decode($response, true);

            if (isset($data["recommendations"])) {
                echo '<h3 class="mb-4">🍴 Recommended Foods</h3>';
                echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">';
                foreach ($data["recommendations"] as $food) {
                    $food_url = urlencode($food);
                    echo '
                    <div class="col">
                        <div class="card food-card h-100 shadow-sm" onclick="window.location.href=\'menu.php?food='.$food_url.'\'">
                            <div class="card-body">
                                <h5 class="card-title mb-0">'.htmlspecialchars($food).'</h5>
                            </div>
                            <div class="card-footer bg-transparent">
                                <small class="text-muted">🍽️ Click for details</small>
                            </div>
                        </div>
                    </div>';
                }
                echo '</div>';
            } else {
                echo '<div class="alert alert-danger mt-4" role="alert">
                        ⚠️ Error fetching recommendations. Please try again.
                      </div>';
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>