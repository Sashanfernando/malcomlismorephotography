<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve email from the form
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Validate the email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Specify the file where emails will be stored
        $file = 'subscribers.txt';

        // Check if the email already exists
        $subscribers = file($file, FILE_IGNORE_NEW_LINES);
        if (!in_array($email, $subscribers)) {
            // Save the email to the file
            file_put_contents($file, $email . PHP_EOL, FILE_APPEND | LOCK_EX);

            // Show a success message
            echo "Thank you for subscribing!";
        } else {
            // Show a message if the email is already subscribed
            echo "You're already subscribed!";
        }
    } else {
        // Show an error message if the email is invalid
        echo "Invalid email address!";
    }
} else {
    // If the form was not submitted correctly
    echo "Please submit the form.";
}
?>
