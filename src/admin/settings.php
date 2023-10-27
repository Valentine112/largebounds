<?php include "src/admin/php/general.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        use Src\Config\Head; 
        Head::tags();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/admin/css/general.css">
    <title>Photofolio</title>
</head>
<body>
    <?php include "src/admin/template/sidebar/index.html"; ?>

    <main>
        <div class="container home">
            <div class="col-12 justify-content-left">
                <div class="col-10 mr-auto py-4 ml-4">
                    <h3 class="mt-4">Change Password</h3>

                    <div class="mt-5">
                        <div class="col-12 col-lg-6 mt-3">
                            <div id="message">

                            </div>
                            <div class="col-12">
                                <input type="password" placeholder="Old Password" class="form-control form" id="oPassword">
                                <br>
                                <input type="password" placeholder="New Password" class="form-control form" id="nPassword">
                                <br>
                                <button class="btn btn-primary" onclick="cPassword(this)">Change password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="../src/admin/js/general.js"></script>
</html>