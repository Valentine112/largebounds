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

    <?php

        if($activate[1] > 0):
            $row = $activate[0][0];

            if(isset($row['activate']) &&  $row['activate']== '1'){ 
                $sec = 'Active &nbsp;&nbsp;<i style="background-color:green;color:#fff; font-size:20px;" class="fa  fa-refresh" ></i>';
            }else{
                $sec ='Not Active &nbsp;&nbsp;<i class="fa fa-times" style=" font-size:20px;color:red"></i>';
                $usd = 'No investment';
            }

            if(isset($row['pdate']) &&  $row['pdate']== '0'){
                $date = 'No investment';
                $start= $row['duration'];
            }else{
                $date = $row['pdate'];
                $start= $row['date'];
            }

            if($row['pname'] == "" || $row['pname'] == null){
                $row['pname'] = "No investment";
            }

            if($percentage == "" || $percentage == null){
                $percentage = 0;
            }
            
        endif;

    ?>
    
    <main class="activate">
        <div class="row justify-content-between align-items-center">
            <div class="col-6">
                <h1>
                    <span>Activation</span>
                </h1>
            </div>

            <div class="col-6 text-right">
                <h1>
                    <span class="username">Himself</span>
                </h1>
            </div>
        </div>

        <section class="mt-3">
            <div>
                <header>
                    <h5>Activate Package</h5>
                </header>

                <div>
                    <?php
                        if(isset($msg) && $msg != "") {
                            echo $msg;
                        }
                    ?>
                </div>

                <form class="row justify-content-around align-items-center forms" method="POST">
                    <div class="form col-11 col-md-5 col-lg-5 mt-2 mb-2">
                        <label for="first">Package name</label>
                        <h4><?= $row['pname']; ?></h4>
                    </div>

                    <div class="form col-11 col-md-5 col-lg-5 mt-2 mb-2">
                        <label for="first">Amount invested</label>
                        <h4><?= $usd ?></h4>
                    </div>

                    <div class="form col-11 col-md-5 col-lg-5 mt-2 mb-2">
                        <label for="first">Percentage Increase</label>
                        <h4><?= $row['increase']; ?></h4>
                    </div>

                    <div class="form col-11 col-md-5 col-lg-5 mt-2 mb-2">
                        <label for="first">Profit</label>
                        <h4><?= $profit ?></h4>
                    </div>

                    <div class="form col-11 col-md-5 col-lg-5 mt-2 mb-2">
                        <label for="first">Activation date</label>
                        <h4><?= $date; ?></h4>
                    </div>

                    <div class="form col-11 col-md-5 col-lg-5 mt-2 mb-2">
                        <label for="first">End date</label>
                        <h4><?= $Date2; ?></h4>
                    </div>

                    <div class="form col-11 col-md-5 col-lg-5 mt-2 mb-2">
                        <label for="first">Days to end</label>
                        <h4><?= $days; ?></h4>
                    </div>

                    <div class="form col-11 col-md-5 col-lg-5 mt-2 mb-2">
                        <label for="first">Status</label>
                        <h4><?= $sec; ?></h4>
                    </div>

                    <div class="form col-11 col-md-5 col-lg-5 mt-2 mb-2">
                        <label for="first">Amount to invest</label>
                        <input type="number" name="usd" placeholder="Amount to invest" class="form-control" id="pass" require autofocus>
                    </div>
                </div>

                <div class="col-11 col-md-5 mx-auto text-center mt-5">
                    <button type="submit" name="activate" class="btn btn-danger form-control" onclick="update()">Activate</button>
                </div>


                <div class="col-11 col-md-5 mx-auto text-center mt-5">
                    <input type="hidden" name="profit" value="<?php echo $percentage; ?>">
                    <button type="submit" name="switch" class="btn btn-primary form-control">Switch/End package</button>
                </div>

            </div>
        </section>

    </main>
</body>
</html>