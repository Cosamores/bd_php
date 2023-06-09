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
            <div class="col-4 card p-4 m-4">
                <h2 class="p-2 mb-4 bg-dark text-white rounded">Profile Information</h2>
                <img class="avatar border border-5 border-dark p-0 m-5 border-ridge rounded" src="images/userAvatar/<?php echo $_SESSION['MEMBER_IMAGE']; ?>" class="card-img-top" alt="User Image">
                    <div class="card-body p-5 border">
                        <h5 class="card-title p-3 mb-2 bg-dark text-white rounded">User Name: <?php echo $_SESSION['USERNAME']; ?></h5>
                        <p class="card-text pt-4">First Name: <?php echo $_SESSION['FIRSTNAME']; ?></p>
                        <p class="card-text pt-2">Last Name: <?php echo $_SESSION['LASTNAME']; ?></p>
                        <p class="card-text pt-2">Email: <?php echo $_SESSION['EMAIL']; ?></p>
                    </div>
               
            </div>
            <!-- Edit Profile Form -->
            <div class="col-4 card p-4 m-4 card">
                <h2 class="p-2 mb-4 bg-dark text-white rounded">Edit Profile</h2>
                <div class="form-container card p-3">
                <form action="processEditProfile.php" method="post" enctype="multipart/form-data">
                    <div class="form-group p-3 mt-3">
                        <input type="text" class="form-control col-3" placeholder="Username" id="username" name="username" value="<?php echo $_SESSION['USERNAME']; ?>"><br>
                        <input type="submit" class="btn btn-primary" value="Update Username">
                    </div>
                </form>

                <form action="processEditProfile.php" method="post">
                    <div class="form-group p-3 mt-3">
<!--                         <label for="fname" class="form-label"></label><br>
 -->                        <input type="text" class="form-control col-3" id="fname"  placeholder="First Name" name="fname"><br>
                        <input type="submit" class="btn btn-primary" value="Update First Name">
                    </div>
                </form>

                <form action="processEditProfile.php" method="post">
                    <div class="form-group p-3 mt-3">    
<!--                         <label for="lname" class="form-label"></label><br>
 -->                        <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname"><br>
                        <input type="submit" class="btn btn-primary" value="Update Last Name">
                    </div>
                </form>

                <form action="processEditProfile.php" method="post">
                    <div class="form-group p-3 mt-3">    
<!--                         <label for="email" class="form-label">Email:</label><br>
 -->                        <input type="text" class="form-control" id="email" placeholder="Email" name="email"><br>
                        <input type="submit" class="btn btn-primary" value="Update Email">
                    </div>
                </form>

                <form action="processEditProfile.php" method="post" enctype="multipart/form-data">
                    <div class="image form-group p-3 mt-3">    
                        <!-- <label for="image" class="form-label">Image:</label><br> -->
                        <input type="file" class="form-control add-file" id="image" placeholder="Image" name="image"><br>
                        <input type="submit" class="btn btn-primary" value="Update Image">
                    </div>
                </form>
            </div>           
        </div>
        
    </div>
    <div class="col-12 m-4">
                <button class="btn btn-secondary" onclick="location.href='template.php'">Go Back</button>
                </div>
    </div>
    
    <style>
        form {
            display: flex;
            justify-content: center;
          
        }
      
        .btn-primary {
            width: 12rem;
            text-align: center;
            
        }
        .image {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .btn-secondary {
            width: 22rem;
        }
        .form-control {
            width: 13rem;
        }
        .form-control.add-file {
            width: 16rem;
        }

        .card-body {
            box-sizing: border-box;
            max-height: fit-content;
        }
    </style>
</body>
</html>
