<?php
session_start();

// Get form data
$answerText = $_POST['answerText'];
$questionId = $_POST['questionId'];

// Input validation
if (empty($answerText)) {
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

// Insert new answer into the database
$sql = "INSERT INTO Answers (memberId, questionId, answerText) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $_SESSION['MEMBER_ID'], $questionId, $answerText);
$stmt->execute();

// Redirect back to myAnswers.php
header("Location: myAnswers.php");
exit();
?>
