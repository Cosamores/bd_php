<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    
</head>
<body>
<?php
session_start();
if (isset($_SESSION['login_error'])) {
    echo '<p class="error">' . $_SESSION['login_error'] . '</p>';
    unset($_SESSION['login_error']);
}
if (isset($_SESSION['success_message'])) {
    echo $_SESSION['success_message'];
    unset($_SESSION['success_message']);  // Unset the variable so the message doesn't persist
}

?>
    
    <div class="card p-5 m-5 rounded">
    <h2 class="p-2 mb-4 bg-dark text-white rounded">Login</h2>
    <form class="form-group" action="processLogin.php" method="post">
        <label for="username" class="form-label">Username:</label><br>
        <input type="text" class="form-control" id="username" name="username"><br>
        <label for="password" class="form-label">Password:</label><br>
        <input type="password" class="form-control" id="password" name="password"><br>
        <input type="submit" class="btn btn-primary" value="Login">
    </form>
    <button class="btn btn-secondary m-5" onclick="location.href='template.php'">Go Back</button>
</div>
</body>
</html>
