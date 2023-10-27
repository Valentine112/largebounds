<?php require "php/general.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        use Src\Config\Head; 
        Head::tags();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/assets/css/landing.css">
    <link rel="stylesheet" href="../src/assets/css/general.css">
    <title>Photofolio</title>
</head>
<body>
    <?php include "src/template/sb/index.html"; ?>

    <div id="content" class="home deposit">
        
        <?php include "src/template/head.php"; ?>

        <h5 class="mt-3">Account Settings</h5>

        <div>
            <div class="row">
                <div class="col-12 col-md-6 mt-3">
                    <input type="text" class="form-control" placeholder="Fullname" disabled value="<?= $user['fullname']; ?>">
                </div>

                <div class="col-12 col-md-6 mt-3">
                    <input type="text" class="form-control" placeholder="Username" disabled value="<?= $user['username']; ?>">
                </div>

                <div class="col-12 col-md-6 mt-3">
                    <input type="text" class="form-control form" placeholder="Email" value="<?= $user['email']; ?>" id="email">
                </div>

                <div class="col-12 col-md-6 mt-3">
                    <input type="password" class="form-control form" placeholder="Change Password" id="password">
                </div>


                <div class="col-12 mt-3">
                    <input type="password" class="mx-auto col-12 col-md-6 form-control form" placeholder="Confirm your password" id="cPassword">
                </div>

                <div class="col-12 col-md-6 mx-auto mt-4">
                    <button class="btn btn-primary form-control" onclick="update(this)">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Include the notice box here -->
    <?php include "src/template/quick-notice.php"; ?>
</body>
<script src="../src/assets/js/general.js"></script>
</html>