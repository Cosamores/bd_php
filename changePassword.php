<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
</head>
<body>
    <h2>Change Password</h2>
    <form action="processChangePassword.php" method="post">
        <label for="oldPassword">Old Password:</label><br>
        <input type="password" id="oldPassword" name="oldPassword"><br>
        <label for="newPassword">New Password:</label><br>
        <input type="password" id="newPassword" name="newPassword"><br>
        <label for="confirmPassword">Confirm New Password:</label><br>
        <input type="password" id="confirmPassword" name="confirmPassword"><br>
        <input type="submit" value="Change Password">
    </form>
    <button onclick="location.href='template.php'">Go Back</button>
</body>
</html>
