<?php


function isValidEmail($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}


$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

// Check for errors
$errors = [];
if (!isValidEmail($email)) {
  $errors[] = "Invalid email address.";
}
if (empty($subject)) {
  $errors[] = "Please enter a subject.";
}
if (empty($message)) {
  $errors[] = "Please enter a message.";
}


if (!empty($errors)) {
  echo "<b>Errors:</b><br>";
  foreach ($errors as $error) {
    echo "- $error<br>";
  }
} else {

  // Set headers (From address can be set in php.ini or here)
  $headers = "webworks754@gmail.com" . "\r\n" .
            "Reply-To: webworks754@gmail.com" . "\r\n" .
            "Content-Type: text/plain; charset=UTF-8";

  
  if (mail($email, $subject, $message, $headers)) {
    echo "Email sent successfully!";
  } else {
    echo "There was a problem sending the email.";
  }
}

?>