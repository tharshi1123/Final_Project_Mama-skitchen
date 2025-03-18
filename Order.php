<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .menu-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="text-center mb-5">Our Menu</h2>
        
        <!-- Success Message -->
        <?php if(isset($success_message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $success_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            <?php foreach ($menu_items as $item): ?>
            <div class="col">
                <div class="card menu-card h-100 shadow-sm">
                    <!-- Add image if available -->
                    <!-- <img src="<?php echo $item['image']; ?>" class="card-img-top" alt="<?php echo $item['name']; ?>"> -->
                    <div class="card-body">
                        <h5 class="card-title mb-3"><?php echo $item['name']; ?></h5>
                        <p class="card-text text-muted mb-4">
                            <!-- Add description if available -->
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="text-primary mb-0">
                                $<?php echo number_format($item['price'], 2); ?>
                            </h4>
                            <form method="POST" action="Cart.php" class="mb-0">
                                <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                <input type="hidden" name="item_name" value="<?php echo $item['name']; ?>">
                                <input type="hidden" name="item_price" value="<?php echo $item['price']; ?>">
                                <button type="submit" name="add_to_cart" class="btn btn-primary">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <a href="Cart.php" class="btn btn-success btn-lg">
                <i class="fas fa-shopping-cart"></i> View Cart
                <!-- <span class="badge bg-light text-dark ms-2"><?php echo $cart_item_count; ?></span> -->
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>