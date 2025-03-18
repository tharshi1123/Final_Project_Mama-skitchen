<?php
// Include the necessary PHPMailer classes
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$conn = mysqli_connect("localhost", "root", "", "data");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $orderId = $_POST['order_id'];
    $action = $_POST['action'];

    // Fetch order details from the database
    $sql = "SELECT * FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();

    if ($order && $action === 'accept') {
        // Send email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'tharshika.balachandran98@gmail.com'; // Replace with your SMTP username
            $mail->Password = 'xzlbjqfdgdwxmdxn'; // Replace with your SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('tharshika.balachandran98@gmail.com', 'Tharshi'); // Replace with your email and name
            $mail->addAddress($order['email'], $order['name']); // Send email to the customer

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Order Accepted';
            $mail->Body = 'Dear ' . $order['name'] . ',<br>Your order for ' . $order['item'] . ' has been accepted.<br>Thank you for shopping with us!';
            $mail->AltBody = 'Dear ' . $order['name'] . ', Your order for ' . $order['item'] . ' has been accepted. Thank you for shopping with us!';

            $mail->send();
            echo 'Email sent successfully';
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } elseif ($action === 'decline') {
        // Handle decline action (if needed)
    }

    // Redirect back to the orders page after processing
    header('Location: Order.php'); // Replace with your orders page
    exit();
}
?>