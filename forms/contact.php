<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust this path to where you have Composer installed PHPMailer

$mail = new PHPMailer(true);

try {
    // Retrieve form data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $subject = isset($_POST['subject']) ? $_POST['subject'] : 'No subject';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'yousef.elshabrawii0@gmail.com';
    $mail->Password = 'iowu ccsn lqin dpsq';  // Make sure this is correct 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    //Recipients
    $mail->setFrom($email, "Yousef ElShabrawii Portfolio");  // Set sender from the form input
    $mail->addAddress('yousef.elshabrawii@gmail.com', 'Yousef ElShabrawii'); // Replace with the actual recipient's email
    $mail->addReplyTo($email, $name); // Reply-to the sender's email from the form


    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject; // Set subject from the form input
    $mail->Body    = nl2br($message); // Set message body from the form input and convert newlines to <br>
    $mail->AltBody = strip_tags($message); // Plain text body for non-HTML mail clients
    
echo $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
