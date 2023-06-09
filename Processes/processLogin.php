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
    // Set session variables
    $_SESSION['loggedin'] = true;

    $_SESSION['USERNAME'] = $member['userName'];
    $_SESSION['MEMBER_ID'] = $member['memberId'];
    $_SESSION['MEMBER_IMAGE'] = $member['memberImageFileName'];
    $_SESSION['FIRSTNAME'] = $member['firstName'];
    $_SESSION['LASTNAME'] = $member['lastName'];
    $_SESSION['EMAIL'] = $member['emailAddress'];

    // Redirect to logged in page
    header("Location: ../template.php");
/*     exit();
 */} else {
    die('Invalid username or password!');
}
?>