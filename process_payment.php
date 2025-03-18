<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .checkout-card {
            border-radius: 15px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn-pay {
            font-size: 1.1rem;
            padding: 12px 24px;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="checkout-card bg-white p-4 mb-4">
                    <h2 class="mb-4 text-center"><i class="fas fa-shopping-cart"></i> Checkout</h2>
                    
                    <!-- Payment Form -->
                    <form action="payment_success.php" method="post">
                        <!-- Payment Details Card -->
                        <div class="card mb-4 border-primary">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0"><i class="fas fa-credit-card"></i> Payment Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="cardholder_name">Cardholder Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="cardholder_name" name="cardholder_name" placeholder="John Doe" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="card_number">Card Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="expiry_date">Expiry Date</label>
                                        <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required pattern="\d{2}/\d{2}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="cvv">CVV</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required pattern="\d{3}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Card -->
                        <div class="card mb-4 border-info">
                            <div class="card-header bg-info text-white">
                                <h4 class="mb-0"><i class="fas fa-envelope"></i> Contact Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="contact_number">Contact Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="tel" class="form-control" id="contact_number" name="contact_number" placeholder="0771234567" pattern="[0-9]{10}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delivery Address Card -->
                        <div class="card mb-4 border-success">
                            <div class="card-header bg-success text-white">
                                <h4 class="mb-0"><i class="fas fa-map-marker-alt"></i> Delivery Address</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <textarea class="form-control" id="delivery_address" name="delivery_address" rows="3" placeholder="123 Main St, City, Country" required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Fields -->
                        <input type="hidden" name="total_amount" value="<?php echo htmlspecialchars($totalAmount); ?>">
                        <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($totalQuantity); ?>">
                        <?php foreach ($cartItems as $index => $itemName): ?>
                            <input type="hidden" name="item_name_<?php echo $index; ?>" value="<?php echo htmlspecialchars($itemName); ?>">
                        <?php endforeach; ?>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-pay btn-lg">
                                <i class="fas fa-lock"></i> Pay ₹<?php echo number_format($totalAmount, 2); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-2.1.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
        // Add automatic formatting for card number
        document.getElementById('card_number').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\s/g, '').replace(/(\d{4})/g, '$1 ').trim();
        });

        // Add automatic formatting for expiry date
        document.getElementById('expiry_date').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/^(\d\d)(\d)$/g, '$1/$2').replace(/\/\//g, '/');
        });
    </script>
</body>
</html>