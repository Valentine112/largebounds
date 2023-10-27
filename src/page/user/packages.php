<?php
    ini_set("pcre.jit", "0");
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    require "php/general.php";
    use Query\Update;
    use Config\Database;
    use Query\Select;

    $db = new Database;

    if(isset($_POST['choosen'])){
        print_r("HELLO WORLD");
        $pname = $db->real_escape_string($_POST['pname']);
        $increase = $db->real_escape_string($_POST['increase']);
        $bonus = $db->real_escape_string($_POST['bonus']);
        $duration = $db->real_escape_string($_POST['duration']);
        $froms = $db->real_escape_string($_POST['froms']);
        $tos = $db->real_escape_string($_POST['tos']);

        if($value1[0][0]['walletbalance'] < $froms) {
            $msg = "<span class='alert alert-danger'>Insufficient balance!</span>";
        }else{
            $zero = 0;

            $selecting = new Select($db);
            $selecting->more_details("WHERE email = ?, $email");
            $value1 = $selecting->pull("activate, bonus, pname, email", "users");
            $selecting->reset();

            $updating = new Update($db, "SET pname = ?, increase = ?, counting = ?, bonus = ?, duration = ?, pdate = ?, froms = ?, tos = ?, activate = ? WHERE email = ?# $pname# $increase# $duration# $bonus# $duration# $zero# $froms# $tos# $zero# $email");

            if($value1[1] > 0){
                $row = $value1[0][0];

                if(isset($row['email']) && strtolower(trim($row['pname'])) == strtolower(trim($pname))){
                    $msg= "<span class='alert alert-warning'>Package already selected you can only choose a different package!</span>";
                }else{
                    
                    if(isset($row['activate']) &&  $row['activate']=='1'){
                        $msg= "<span class='alert alert-warning'>A Package is already running!</span>";
                    }else{
                        if($updating->mutate("siiiisiiss", "users")) {
                            $msg= " <span class='alert alert-success'>$pname package has been successfully selected! Click <b><a href='activate.php'>HERE</a></b> to activate package.</span>";
                        } else {
                            $msg= "<span class='alert alert-danger'>Package was not selected !</span>";
                        }
                    }  
                }
            }  
        }
    }
?>
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
    
    <main class="profile packages">
        <div class="row justify-content-between align-items-center">
            <div class="col-6">
                <h1>
                    <span>Packages</span>
                </h1>
            </div>

            <div class="col-6 text-right">
                <h1>
                    <span class="username">Himself</span>
                </h1>
            </div>
        </div>

        <section class="mt-3">
            <div class="col-12 text-center justify-content-center">
                <?php
                    if(isset($msg) && !empty($msg)):
                        echo $msg;
                    endif;
                ?>
            </div>
            <div class="row justify-content-around align-items-center">
                <?php 
                if($packages[1] > 0):
                    foreach($packages[0] as $ind => $data): ?> 
                    <form class="col-11 col-md-5 col-lg-5 mt-2 mb-2" method="POST"> 
                        <input type="hidden" name="pname" value=" <?= $data['pname'];?>">
                        <input type="hidden" name="froms" value=" <?= $data['froms'];?>">
                            <input type="hidden" name="tos" value=" <?= $data['tos'];?>">
                        <input type="hidden" name="bonus" value=" <?= $data['bonus'];?>">
                        <input type="hidden" name="increase" value=" <?= $data['increase'];?>">
                        <input type="hidden" name="duration" value=" <?= $data['duration'];?>">
                        <div class="package-box">
                            <div class="mb-3">
                                <h4 class="<?= strtolower($data['pname']); ?>">
                                    <?= $data['pname']; ?>
                                </h4>
                            </div>

                            <div>
                                <ul>
                                    <li>Minimum - <sup>$</sup><?= $data['froms']; ?></li>
                                    <li>
                                        Maximum - <sup>$</sup>
                                        <?php
                                            if($data['tos'] == 0){
                                                echo "Upwards";
                                            }else{
                                                echo $data['tos'];
                                            }
                                        ?>
                                    </li>
                                    <li>Percentage - <?= $data['increase']; ?>%</li>
                                    <li>Duration - <?= $data['duration']; ?> days</li>
                                    <li>Interval - 
                                        <?php
                                            if($data['pname'] == "VIP"){
                                                echo "3 days";
                                            }else{
                                                echo "Daily";
                                            }
                                        ?>
                                    </li>
                                    <li>Referral Bonus - <sup>$</sup><?= $data['bonus']; ?></li>
                                </ul>
                            </div>

                            <div>
                                <button type="submit" name="choosen" class="btn">Select</button>
                            </div>
                        </div>
                    </form>
                <?php endforeach; endif; ?>
            </div>
        </section>
    </main>
</body>
</html>