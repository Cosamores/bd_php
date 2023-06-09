<?php
// Start the session
session_start();

// Get form data
$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

// Input validation
if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
    die('Please fill all required fields!');
}

if ($newPassword !== $confirmPassword) {
    die('New password and confirm password do not match!');
}

// Database credentials
$servername = "localhost";
$database = "todf";
$dbusername = "root";
$dbpassword = "";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch member from the database
$sql = "SELECT * FROM Member WHERE userName = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['USERNAME']);
$stmt->execute();
$result = $stmt->get_result();
$member = $result->fetch_assoc();

// Verify old password
if ($member && password_verify($oldPassword, $member['password'])) {
    // Update password
    $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE Member SET password = ? WHERE userName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $newPasswordHashed, $_SESSION['USERNAME']);
    $stmt->execute();
} else {
    die('Old password is incorrect!');
}

// Redirect to change password page
header("Location: ../changePassword.php");
echo "<script>alert('Your password was changed.');</script>";
exit();
?>
