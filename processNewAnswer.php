<?php
session_start();
include("PROCESSES/processConnectDb.php");

if(isset($_POST['submitAnswer']) && isset($_SESSION['username'])) {
    $newAnswer = $_POST['newAnswer'];
    $questionId = $_POST['questionId'];
    $memberId = $_SESSION['MEMBER_ID']; 

    $sql = "INSERT INTO AnswerDraftLine (answerDraft, answerDraftDate, answerDraftApproval, memberId, questionId) 
            VALUES (?, CURDATE(), 'PENDING', ?, ?)";

    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "sii", $newAnswer, $memberId, $questionId);
        if(mysqli_stmt_execute($stmt)){
            echo "Your answer has been submitted for approval.";
        } else{
            echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
        }
    } else{
        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
    }
} else {
    echo "You must be logged in to submit an answer.";
}
?>
