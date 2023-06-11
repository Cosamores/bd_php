<?php
// Start the session
session_start();

// Check if the user is logged in and is an admin
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "admin"){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$questions = $answers = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Get all questions
    $sql = "SELECT * FROM questions";
    if($stmt = mysqli_prepare($link, $sql)){
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            $questions = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Get all answers
    $sql = "SELECT * FROM answers";
    if($stmt = mysqli_prepare($link, $sql)){
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            $answers = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Admin Page</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Get All Questions and Answers">
            </div>
        </form>
        <?php
        if(!empty($questions)){
            echo "<h3>Questions</h3>";
            foreach($questions as $question){
                echo "<p>" . $question["question_text"] . "</p>";
            }
        }

        if(!empty($answers)){
            echo "<h3>Answers</h3>";
            foreach($answers as $answer){
                echo "<p>" . $answer["answer_text"] . "</p>";
            }
        }
        ?>
    </div>
</body>
</html>
