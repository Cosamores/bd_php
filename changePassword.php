<?php
    session_start();
    if (isset($_SESSION['password_success_message'])) {
        echo $_SESSION['password_success_message'];
        unset($_SESSION['password_success_message']);  // Unset the variable so the message doesn't persist
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="card p-5 m-5 rounded">
    <h2 class="p-2 mb-4 bg-dark text-white rounded">Change Password</h2>
    <form action="processChangePassword.php" method="post">
        <label for="oldPassword" class="form-label">Old Password:</label><br>
        <input type="password" class="form-control" id="oldPassword" name="oldPassword"><br>
        <label for="newPassword" class="form-label">New Password:</label><br>
        <input type="password" class="form-control" id="newPassword" name="newPassword"><br>
        <label for="confirmPassword" class="form-label">Confirm New Password:</label><br>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"><br>
        <input type="submit" class="btn btn-primary" value="Change Password">
    </form>
    <button class="btn btn-secondary m-5" onclick="location.href='template.php'">Go Back</button>
</body>
</html>
