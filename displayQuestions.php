<?php
include("PROCESSES/processConnectDb.php");

if(isset($_REQUEST['SubcategoryID']))
{
    $sql = "SELECT SubcategoryName 
              FROM Subcategory
             WHERE SubcategoryID = ".$_REQUEST['SubcategoryID'];

    if($resultSet=mysqli_query($conn, $sql)){
        while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){
            $pageTitle = $record['SubcategoryName'];
        }
    }          

    echo "<h1>Subcategory: $pageTitle</h1>";

    // Fetch questions related to the selected subcategory
    $sql = "SELECT QuestionText 
              FROM Questions
             WHERE SubcategoryID = ".$_REQUEST['SubcategoryID'];

    if($resultSet=mysqli_query($conn, $sql)){
        while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){
            echo "<p>" . $record['QuestionText'] . "</p>";
        }
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

    echo "<h1>Category: $pageTitle</h1>";

    // Fetch questions related to the selected category
    $sql = "SELECT QuestionText 
              FROM Questions
             WHERE CategoryID = (SELECT CategoryID FROM Category WHERE CategoryName = '".$_REQUEST['CategoryName']."')";

    if($resultSet=mysqli_query($conn, $sql)){
        while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){
            echo "<p>" . $record['QuestionText'] . "</p>";
        }
    }
}
?>
