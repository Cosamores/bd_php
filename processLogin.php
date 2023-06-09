<?php
// Start the session
session_start();

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Input validation
if (empty($username) || empty($password)) {
    die('Please fill all required fields!');
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
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$member = $result->fetch_assoc();

// Verify password
if ($member && password_verify($password, $member['password'])) {
    // Regenerate session ID to prevent session hijacking
    session_regenerate_id();

    // Set session variables

    $_SESSION['USERNAME'] = $member['userName'];
    $_SESSION['MEMBER_ID'] = $member['memberId'];
    $_SESSION['MEMBER_IMAGE'] = $member['memberImageFileName'];
    $_SESSION['FIRSTNAME'] = $member['firstName'];
    $_SESSION['LASTNAME'] = $member['lastName'];
    $_SESSION['EMAIL'] = $member['emailAddress'];
    
    $_SESSION['loggedin'] = true;
   
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
        <div class="card-text m-2 ml-4 p-2">Welcome to Questions!</div>
        <button class="btn btn-success m-4" id="dismissBtn">Dismiss</button>
    </div>
    ';
    // Redirect to logged in page
    header("Location: template.php");
    exit();
} else {
    // Set error message
    $_SESSION['login_error'] = 'Invalid username or password!';

    // Redirect to login page
    header("Location: memberLogin.php");
    exit();
}

?>