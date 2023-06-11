<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  // You can perform further processing here, such as sending an email or storing the data in a database

  // Redirect to a thank you page
  echo "<script>alert('Message sent successfully!'); window.location.href='contact.php';</script>";
} else {
  // Error sending email
  echo "<script>alert('Error sending message. Please try again later.'); window.location.href='index.php';</script>";
}
?>

  