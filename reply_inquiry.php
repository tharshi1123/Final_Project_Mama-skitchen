<?php
// Include PHPMailer library if not already included
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor\autoload.php'; // Path to PHPMailer's autoload file

// Database connection
$conn = new mysqli('localhost', 'root', '', 'data'); // Update with your database credentials
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['inquiry_id']) && isset($_POST['reply_message'])) {
    $inquiry_id = $conn->real_escape_string($_POST['inquiry_id']);
    $reply_message = $conn->real_escape_string($_POST['reply_message']);

    // Fetch inquiry details
    $sql = "SELECT email, subject FROM inquiries WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $inquiry_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $inquiry = $result->fetch_assoc();
        $toEmail = $inquiry['email'];
        $subject = "Re: " . $inquiry['subject'];
        $message = "Dear Customer,\n\n" . $reply_message . "\n\nBest regards,\nABC restaurant chain";

        // Send email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'tharshika.balachandran98@gmail.com'; // Replace with your SMTP username
            $mail->Password = 'xzlbjqfdgdwxmdxn'; // Replace with your SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;


            //Recipients
            $mail->setFrom('tharshika.balachandran98@gmail.com', 'ABC restaurant');
            $mail->addAddress($toEmail);

            //Content
            $mail->isHTML(false); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            echo "Reply sent successfully!";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Inquiry not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
