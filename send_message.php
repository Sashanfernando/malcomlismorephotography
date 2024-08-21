<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

   
    $to = "samithasashan2002@gmail.com"; 
    $subject = "New Contact Form Submission";
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    
    $email_body = "You have received a new message from the contact form.\n\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Message:\n$message\n";

  
    if (mail($to, $subject, $email_body, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }
} else {
    
    header("Location: contact.html");
    exit();
}
?>
