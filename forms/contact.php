<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Define recipient email
    $to = "aratakokonoe91@gmail.com, markbenedict54@yahoo.com"; // Replace with your actual email address
    
    // 2. Retrieve and sanitize form data
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);
    
    // 3. Validate email address

    $secretKey = 'your-secret-key'; // Replace with your reCAPTCHA secret key
    $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($recaptchaUrl . "?secret=" . $secretKey . "&response=" . $recaptchaResponse);
    $responseKeys = json_decode($response, true);

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // 4. Set up email parameters

    $subject = "Contact Form Submission from $name";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // 5. Send the email and check if it was successful

    if (mail($to, $subject, $body, $headers)) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email.";
    }
} else {
    echo "Invalid request.";
}
?>
