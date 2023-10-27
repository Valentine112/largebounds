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
    <title>Largebounds Corporation</title>
</head>
<body>
    <?php include "src/template/sb/index.html"; ?>
    
    <main class="profile">
        <div class="row justify-content-between align-items-center">
            <div class="col-6">
                <h1>
                    <span>Profile</span>
                </h1>
            </div>

            <div class="col-6 text-right">
                <h1>
                    <span class="username">Himself</span>
                </h1>
            </div>
        </div>

        <section class="mt-5">
            <h3>Change Profile</h3>
            <div class="row justify-content-around align-items-center mt-3 profile-form">
                <div class="col-11 col-md-6">
                    <label for="fullname">Fullname</label>
                    <input type="text" placeholder="Fullname" class="form" id="fullname">
                </div>

                <div class="col-11 col-md-6">
                    <label for="number">Phone number</label>
                    <input type="text" placeholder="Phone number" class="form" id="number">
                </div>

                <div class="col-11 col-md-6">
                    <label for="password">Confirm password</label>
                    <input type="text" placeholder="Confirm password" class="form" id="password">
                </div>

                <div class="col-11 col-md-6">
                    <label for="password">Date Joined</label>
                    <input type="text" placeholder="Date joined" class="form" id="date" disabled>
                </div>

                <div class="col-11 col-md-6">
                    <button class="btn btn-primary form-control">Submit</button>
                </div>
            </div>
        </section>

    </main>
</body>
</html>