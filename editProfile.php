<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    session_start();
    ?>
    <div class="container mt-5">
        <div class="row">
            <!-- Profile Information -->
            <div class="col-md-6">
                <h2>Profile Information</h2>
                <div class="card">
                    <img src="<?php echo $_SESSION['MEMBER_IMAGE']; ?>" class="card-img-top" alt="User Image">
                    <div class="card-body">
                        <h5 class="card-title">User Name: <?php echo $_SESSION['USERNAME']; ?></h5>
                        <p class="card-text">First Name: <?php echo $_SESSION['FIRSTNAME']; ?></p>
                        <p class="card-text">Last Name: <?php echo $_SESSION['LASTNAME']; ?></p>
                        <p class="card-text">Email: <?php echo $_SESSION['EMAIL']; ?></p>
                    </div>
                </div>
            </div>
            <!-- Edit Profile Form -->
            <div class="col-md-6">
                <h2>Edit Profile</h2>
                
                <form action="Processes/processEditProfile.php" method="post">
    <label for="fname" class="form-label">First Name:</label><br>
    <input type="text" class="form-control" id="fname" name="fname"><br>
    <input type="submit" class="btn btn-primary" value="Update">
</form>

<form action="processEditProfile.php" method="post">
    <label for="lname" class="form-label">Last Name:</label><br>
    <input type="text" class="form-control" id="lname" name="lname"><br>
    <input type="submit" class="btn btn-primary" value="Update">
</form>

<form action="processEditProfile.php" method="post">
    <label for="email" class="form-label">Email:</label><br>
    <input type="text" class="form-control" id="email" name="email"><br>
    <input type="submit" class="btn btn-primary" value="Update">
</form>

<form action="processEditProfile.php" method="post" enctype="multipart/form-data">
    <label for="image" class="form-label">Image:</label><br>
    <input type="file" class="form-control" id="image" name="image"><br>
    <input type="submit" class="btn btn-primary" value="Update">
</form>

            </div>
        </div>
        <div class="container">
        <button class="btn btn-secondary" onclick="location.href='template.php'">Go Back</button>
        </div>
    </div>
</body>
</html>
