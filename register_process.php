<?php
session_start();

// Get form data
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$avatar = $_FILES['avatar'];

// Input validation
$errors = [];
if (empty($fname) || empty($lname) || empty($email) || empty($username) || empty($password) || empty($cpassword)) {
    $errors[] = 'Please fill all required fields!';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format!';
}

if ($password !== $cpassword) {
    $errors[] = 'Password and Confirm password should match!';
}

// If there are errors, redirect back to the registration page
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: register.php");
    exit();
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Handle avatar upload
$avatarFileName = '../images/userAvatar/defaultUser.png';
if ($avatar['error'] == 0) {
    $tmpName = $avatar['tmp_name'];
    $avatarFileName = '../images/userAvatar/' . uniqid() . '-' . $username;
    move_uploaded_file($tmpName, $avatarFileName);
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

// Check if username already exists
$sql = "SELECT * FROM Member WHERE userName = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $errors[] = 'Username already exists!';
    $_SESSION['errors'] = $errors;
    header("Location: register.php");
    exit();
}

// Insert new member into the database
$sql = "INSERT INTO Member (firstName, lastName, emailAddress, userName, password, memberImageFileName) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $fname, $lname, $email, $username, $hashedPassword, $avatarFileName);
$stmt->execute();

// Get the ID of the new member
$member_id = $conn->insert_id;

// Set session variables
$_SESSION['loggedin'] = true;
$_SESSION['FIRSTNAME'] = $fname;
$_SESSION['LASTNAME'] = $lname;
$_SESSION['USERNAME'] = $username;
$_SESSION['MEMBER_ID'] = $member_id;
$_SESSION['MEMBER_IMAGE'] = $avatarFileName;
$_SESSION['EMAIL'] = $email;

// Redirect to login page
header("Location: index.php");
exit();
?>
