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

$newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);
// Verify old password
if ($member && password_verify($oldPassword, $member['password'])) {
    // Update password
   
    $sql = "UPDATE Member SET password = ? WHERE userName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $newPasswordHashed, $_SESSION['USERNAME']);
    $stmt->execute();

    session_start();

$_SESSION['password_success_message'] = '
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const successMessage = document.querySelector(".success-message");
        const dismissBtn = document.querySelector("#dismissBtn");
        dismissBtn.addEventListener("click", () => {
            successMessage.style.display = "none";
        });
    });
    </script>
    
    <div class="success-message card rounded border p-0 m-5">
        <div class="card-title border p-3 bg-primary rounded">Success!</div>
        <div class="card-text m-2 ml-4 p-2">The password was changed!</div>
        <button class="btn btn-success m-4" id="dismissBtn">Dismiss</button>
    </div>
';


} else {
    die('Old password is incorrect!');
}

// Redirect to change password page
header("Location: changePassword.php");
exit();
?>
