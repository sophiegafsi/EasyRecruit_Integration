<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';

// Function to send confirmation email
function sendConfirmationEmail($to, $subject, $message) {
    $mail = new PHPMailer(true); // Create a new PHPMailer instance

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'melekzapa45@gmail.com'; // Your Gmail address
        $mail->Password = 'ruxv yxrt ghlh olce'; // Your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 25;

        // Email content
        $mail->setFrom('melekzapa45@gmail.com', 'Administrator of EasyRecruit'); // Sender email and name
        $mail->addAddress($to); // Recipient email
        $mail->Subject = $subject; // Email subject
        $mail->Body = $message; // Email body
        $mail->isHTML(false); // Plain text email

        // Send email
        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Email failed to send
    }
}

// Your existing code
include "../../Controller/PostController.php";

$idPost = $_GET['id'];
$postController = new PostController();
$result = $postController->setPostStatusToTrue($idPost);

if ($result) {
    // Get the post information for email content
    $post = $postController->getPost($idPost);

    // Set the recipient email address
    $recipientEmail = 'iheb.jlassi@esprit.tn'; // Change to the recipient's email address

    // Email subject and message
    $subject = 'Post Confirmation';
    $message = "The post titled '" . $post['post_title'] . "' has been reviewed by the admin and posted successfuly.";

    // Send the confirmation email
    if (sendConfirmationEmail($recipientEmail, $subject, $message)) {
        // Email sent successfully
        header("Location: AfficherPosts.php");
        exit;
    } else {
        echo "Error: Failed to send confirmation email.";
    }
} else {
    echo "Error: Failed to toggle post status.";
}
?>
