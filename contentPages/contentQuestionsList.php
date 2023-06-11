<?php
include("PROCESSES/processConnectDb.php");

if(isset($_REQUEST['SubcategoryID']))
{
    $sql = "SELECT SubcategoryName 
              FROM Subcategory
             WHERE SubcategoryID = ".$_REQUEST['SubcategoryID'];

    $resultSet = mysqli_query($conn, $sql);
    if(mysqli_num_rows($resultSet) > 0){
        while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){  
            $pageTitle = $record['SubcategoryName'];
        }
    }          

    echo '<h1 class="text-center text-primary mb-4 border border-4 rounded border-info p-3">Subcategory: ' . $pageTitle . '</h1>';

    // Fetch questions related to the selected subcategory
    $sql = "SELECT question, questionCreationDate, username 
              FROM Questions
              INNER JOIN Member ON Questions.memberId = Member.memberId
             WHERE SubcategoryID = ".$_REQUEST['SubcategoryID'];

    $resultSet = mysqli_query($conn, $sql);
    if(mysqli_num_rows($resultSet) > 0){
        while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){
            echo '<div class="card mb-3">';
            echo '<div class="card-header">';
            echo 'Asked by <span class="text-primary">' . $record['username'] . '</span> on ' . $record['questionCreationDate'];
            echo '</div>';
            echo '<div class="card-body fw-bolder fs-3">';
            echo '<p class="card-text">' . $record['question'] . '</p>';
    // Fetch questions related to the selected subcategory
$sql = "SELECT question, questionCreationDate, username, questionId 
FROM Questions
INNER JOIN Member ON Questions.memberId = Member.memberId
WHERE SubcategoryID = ".$_REQUEST['SubcategoryID'];

$resultSet = mysqli_query($conn, $sql);
if(mysqli_num_rows($resultSet) > 0){
while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){
echo '<div class="card mb-3">';
echo '<div class="card-header">';
echo 'Asked by <span class="text-primary">' . $record['username'] . '</span> on ' . $record['questionCreationDate'];
echo '</div>';
echo '<div class="card-body fw-bolder fs-3">';
echo '<p class="card-text">' . $record['question'] . '</p>';

// Fetch answers related to the current question
$sqlAnswers = "SELECT answer, answerDate, username 
              FROM AnswerLine
              INNER JOIN Member ON AnswerLine.memberId = Member.memberId
              WHERE questionId = ".$record['questionId'];

$resultSetAnswers = mysqli_query($conn, $sqlAnswers);
if(mysqli_num_rows($resultSetAnswers) > 0){
  while($recordAnswer = mysqli_fetch_array($resultSetAnswers, MYSQLI_ASSOC)){
      echo '<div class="card mt-3">';
      echo '<div class="card-header">';
       echo 'Answered by <span class="text-success">' . $recordAnswer['username'] . '</span> on ' . $recordAnswer['answerDate'];
       echo '</div>';
      echo '<div class="card-body">';
      echo '<p class="card-text fs-4">' . $recordAnswer['answer'] . '</p>';
      echo '</div>';
      echo '</div>';
  }
} else {
  echo '<p>No answers found for this question.</p>';
}

// Check if user is logged in to display the form for submitting a new answer
if(isset($_SESSION['username'])){
  echo '<form class="mt-3" action="processAnswers.php" method="POST">';
  echo '<div class="mb-3">';
  echo '<label for="newAnswer" class="form-label">Your Answer</label>';
  echo '<textarea class="form-control" id="newAnswer" name="newAnswer" rows="3"></textarea>';
  echo '</div>';
  echo '<input type="hidden" name="questionId" value="' . $record['questionId'] . '">';
  echo '<button type="submit" class="btn btn-primary" name="submitAnswer">Submit Answer for Approval</button>';
  echo '</form>';
}

echo '</div>';
echo '</div>';
}
} else {
echo '<p class="text-center">No questions found in this subcategory.</p>';
}            
        }
    } else {
        echo '<p class="text-center">No questions found in this subcategory.</p>';
    }   
}

if(isset($_REQUEST['CategoryName']))
{
    $sql = "SELECT CategoryName 
              FROM Category
             WHERE CategoryName = '".$_REQUEST['CategoryName']."'";

    if($resultSet=mysqli_query($conn, $sql)){
        while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){
            $pageTitle = $record['CategoryName'];
        }
    }          

    echo '<h1 class="text-center text-primary mb-4 border border-4 rounded border-info p-3">Category: <span class="text-primary">' . $pageTitle . '</span></h1>';

    // Fetch questions related to the selected category
    $sql = "SELECT question, questionCreationDate, username 
              FROM Questions
              INNER JOIN Member ON Questions.memberId = Member.memberId
             WHERE CategoryID IN (SELECT CategoryID FROM Category WHERE CategoryName = '".$_REQUEST['CategoryName']."')";

    $resultSet = mysqli_query($conn, $sql);
    if(mysqli_num_rows($resultSet) > 0){
        while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){
            echo '<div class="card mb-3">';
            echo '<div class="card-header">';
            echo 'Asked by <span class="text-primary">' . $record['username'] . '</span> on ' . $record['questionCreationDate'];
            echo '</div>';
            echo '<div class="card-body fw-bolder fs-3">';
            echo '<p class="card-text">' . $record['question'] . '</p>';

            // Fetch answers related to the current question
$sqlAnswers = "SELECT answer, answerDate, username 
FROM AnswerLine
INNER JOIN Member ON AnswerLine.memberId = Member.memberId
WHERE questionId = ".$record['questionId'];

$resultSetAnswers = mysqli_query($conn, $sqlAnswers);
if(mysqli_num_rows($resultSetAnswers) > 0){
while($recordAnswer = mysqli_fetch_array($resultSetAnswers, MYSQLI_ASSOC)){
echo '<div class="card mt-3">';
echo '<div class="card-header">';
echo 'Answered by <span class="text-success">' . $recordAnswer['username'] . '</span> on ' . $recordAnswer['answerDate'];
echo '</div>';
echo '<div class="card-body">';
echo '<p class="card-text fs-4">' . $recordAnswer['answer'] . '</p>';
echo '</div>';
echo '</div>';
}
} else {
echo '<p>No answers found for this question.</p>';
}
                    }
    } else {
        echo '<p class="text-center">No questions found in this category.</p>';
    }
    
}
?>
