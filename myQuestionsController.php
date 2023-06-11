<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['USERNAME'])) {
    // User is not logged in, redirect to login page
    header("location: memberLogin.php");
    exit;
}

include("PROCESSES/processConnectDb.php");

$member_ID = $_SESSION['MEMBER_ID'];

// Fetch user's questions from the database
$sql = "SELECT * FROM Questions WHERE MemberID = ?";
if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, "i", $param_member_id);
    $param_member_id = $member_ID;
    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);
        $questions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else{
        $error_message = "Oops! Something went wrong. Please try again later.";
    }
    mysqli_stmt_close($stmt);
}

// Separate questions into approved and draft
$approved_questions = array_filter($questions, function($question) {
    return $question['Status'] == 'Approved';
});
$draft_questions = array_filter($questions, function($question) {
    return $question['Status'] == 'Draft';
});
?>
