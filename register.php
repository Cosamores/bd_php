<?php
    session_start();
    if (isset($_SESSION['password_success_message'])) {
        echo $_SESSION['password_success_message'];
        unset($_SESSION['password_success_message']);  // Unset the variable so the message doesn't persist
    }
    
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Register</title>
  </head>
  <body>
    
  <div class="card p-5 m-5 rounded"> 
    <h2 class="p-2 mb-4 bg-dark text-white rounded">Register</h2>
           <form class="form-group smt-4" action="register_process.php" method="post" enctype="multipart/form-data">
            <label for="fname" class="form-label">First Name:</label><br>
            <input type="text" class="form-control" id="fname" name="fname" required><br>
            <label for="lname" class="form-label">Last Name:</label><br>
            <input type="text" class="form-control" id="lname" name="lname" required><br>
            <label for="email" class="form-label">Email:</label><br>
            <input type="email" class="form-control" id="email" name="email" required><br>
            <label for="username" class="form-label">Username:</label><br>
            <input type="text" class="form-control" id="username" name="username" required><br>
            <label for="password" class="form-label">Password:</label><br>
            <input type="password" class="form-control" id="password" name="password" required><br>
            <label for="cpassword" class="form-label">Confirm Password:</label><br>
            <input type="password" class="form-control" id="cpassword" name="cpassword" required><br>
            <label for="avatar" class="form-label">Avatar:</label><br>
            <input type="file" class="form-control" id="avatar" name="avatar"><br>
            <input type="submit" class="btn btn-primary" value="Register">
        </form>
        <button class="btn btn-secondary m-5" onclick="location.href='template.php'">Go Back</button>
    </div> 

        <style>
            .btn-container {
                padding: 20px 0 0 50px;
            }
            .form {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            h2 {
                padding: 20px;
            }
        </style>
    </body>
</html>
