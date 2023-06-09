<?php
// Start the session
session_start();

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

// Get form data
$fname = $_POST['fname'] ?? null;
$lname = $_POST['lname'] ?? null;
$email = $_POST['email'] ?? null;
$avatar = $_FILES['image'] ?? null;

// Update first name
if ($fname !== null) {
    $sql = "UPDATE Member SET firstName = ? WHERE userName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $fname, $_SESSION['USERNAME']);
    $stmt->execute();
    $_SESSION['fname'] = $fname;
}

// Update last name
if ($lname !== null) {
    $sql = "UPDATE Member SET lastName = ? WHERE userName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $lname, $_SESSION['USERNAME']);
    $stmt->execute();
    $_SESSION['lname'] = $lname;
}

// Update email
if ($email !== null) {
    $sql = "UPDATE Member SET emailAddress = ? WHERE userName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $_SESSION['USERNAME']);
    $stmt->execute();
    $_SESSION['EMAIL'] = $email;
}

// Update avatar
if ($avatar !== null) {
    // Image upload
    $target_dir = "images/userAvatar/";
    $target_file = $target_dir . basename($avatar["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($avatar["tmp_name"]);
    if($check === false) {
        die("File is not an image.");
    }

    if (move_uploaded_file($avatar["tmp_name"], $target_file)) {
        $sql = "UPDATE Member SET memberImageFileName = ? WHERE userName = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $target_file, $_SESSION['USERNAME']);
        $stmt->execute();
        $_SESSION['MEMBER_IMAGE'] = $target_file;
    } else {
        die("Sorry, there was an error uploading your file.");
    }
}

// Redirect to edit profile page
header("Location: ../editProfile.php");
exit();
?>
