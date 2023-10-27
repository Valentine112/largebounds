<?php
    use Config\Database;
    use Query\Select;
    use Query\Update;
    use Service\Func;

    $db = new Database;
    $selecting = new Select($db);
    // Check if user is logged in
    if(empty($_SESSION['token'])) header("location: ../login");

    // Check if session is already created
    $user = null;
    if(!empty($_SESSION['token'])):
        (int) $zero = 0;
        // ------- FETCH USER INFO --------- //
        $data = [
            "token" => $_SESSION['token'],
            "1" => "1",
            "needle" => "*",
            "table" => "user"
        ];
        $user = Func::searchDb($db, $data, "AND");
        $userId = $user['id'];
        $email = $user['email'];

        //if($result): header("location: login?action=logout");

        $wallet_balance = $user['walletbalance'] ?? 0;
        $profit = $user['profit'] ?? 0;
        $increase = $user['increase'] ?? 0;
        $counting = $user['counting'] ?? 0;
        $duration = $user['duration'] ?? 0;
        $usd = $user['usd'] ?? 0;

        $withdrawn = 0;
        $wstatus = 'completed';
        $data = [
            "email" => $email,
            "status" => 'completed',
            'needle' => 'SUM(moni)',
            'table' => 'wbtc'
        ];
        $withdrawn = Func::searchDb($db, $data, "AND");

        if(!empty($user['pdate']) && $user['pdate'] != '0' && ($duration != null || $duration != 0) && $active == 1) {

            $percentage = ($increase/100) * $usd;

            $ptime = strtotime($pdate);
            $ctime = strtotime(date('Y-m-d H:i:s'));

            $daysCount = (60 * 60) * 24;

            $daysCount = (($ctime - $ptime)/$daysCount);

            $daysCount = floor($daysCount);

            $zero = 0;
            $empty = "";

            // First check if there is a running package
            if($active === 1):

                // Check if the due date has been reached
                if($daysCount >= $duration):
                    $totalProfit = 0;

                    if($pkgName == "MINING"):
                        // MINING PACKAGE
                        $maxDays = floor($duration / 3);
                        $totalProfit = $maxDays * $percentage;

                    else:
                        // REGULAR PACKAGES
                        $totalProfit = $percentage * $duration;

                    endif;
                    // Reset
                    // Due date has been reached
                    // Reset everything regarding the package

                    $updating = new Update($link, "SET activate = ?, walletbalance = walletbalance + ?, profit = ?, increase = ?, pname = ?, counting = ?, duration = ?, froms = ? WHERE email = ?#, $zero# $totalProfit# $zero# $zero# $empty# $zero# $zero# $zero# $email");
                    $updating->mutate('iiiisiiis', 'users');

                else:
                    if($pkgName == "MINING"):
                        // MINING PACKAGE

                        // Check if a 3 day interval has been reached
                        $remainder = $daysCount % 3;
                        $interval = ($daysCount - $remainder) / 3;

                        $totalProfit = $percentage * $interval;

                    else:
                        // REGULAR PACKAGES
                        $totalProfit = $percentage * $daysCount;

                    endif;

                    // Due date hasn't been reached yet
                    // Still update the profit

                    $updating = new Update($link, "SET profit = ? WHERE email = ?# $totalProfit# $email");
                    $updating->mutate('is', 'users');

                endif;
            endif;
        }else{
            $daily = "";
            $percentage ="0";
        }


        // Fetching transaction activities
        $arr = [
            'type' => 'topup',
            'filled' => 'empty'
        ];

        $arr1 = [
            'type' => 'withdraw',
            'filled' => 'empty'
        ];

        $withdraw = [];
        $pay = [];

        $selecting->more_details("WHERE email = ?# $email");
        $action = $selecting->action("usd, status, date", "btc");
        if($action != null) return $action;
        $selecting->reset();

        $values = $selecting->pull();
        if($values[1] > 0){
            $data = $values[0];
            foreach($data as $info) {
                $arr['amount'] = $info['usd'];
                $arr['status'] = $info['status'];
                $arr['date'] = $info['date'];
                $arr['time'] = strtotime($info['date']);
                $arr['filled'] = "filled";

                array_push($pay, $arr);
            }
        }
        
        $selecting = new Select($db);
        $selecting->more_details("WHERE email = ?# $email");
        $action = $selecting->action("moni, status, date", "wbtc");
        $selecting->reset();
        $values = $selecting->pull();
        if($values[1] > 0){
            $data = $values[0];
            foreach($data as $info) {
                $arr1['amount'] = $info['moni'];
                $arr1['status'] = $info['status'];
                $arr1['date'] = $info['date'];
                $arr1['time'] = strtotime($info['date']);
                $arr1['filled'] = "filled";

                array_push($withdraw, $arr1);
            }
        }

        $activities = array_merge($pay, $withdraw);

        usort($activities, function($a, $b) {
            $t1 = $a['time'];
            $t2 = $b['time'];
            return $t2 - $t1;
        });

        $activities = array_splice($activities, 0, 10);

        $selecting = new Select($db);
        $selecting->more_details("WHERE id = ? LIMIT 1# $userId");
        $action = $selecting->action("pdate, duration, increase, usd, refcode, walletbalance, initial_balance, profit, counting, activate", "user");
        if($action != null) return $action;
        $value = $selecting->pull();
        $selecting->reset();
        if($value[1] > 0) {
            $row = $value[0][0];
    
            $pdate = $row['pdate'];
            $duration = $row['duration'];
            $increase = $row['increase'];
            $usd = $row['usd'];
            $refcode = $row['refcode'];
            $wallet_balance = $row['walletbalance'];
            $initial_balance = $row['initial_balance'];
            $profit = $row['profit'];
            $counting = $row['counting'];
            $active = $row['activate'];
    
            if($wallet_balance == null) $wallet_balance = 0;
            if($profit == null) $profit = 0;
            if($increase == null) $increase = 0;
            if($counting == null) $counting = 0;
            if($duration == null) $duration = 0;
            if($usd == null) $usd = 0;
        
        }
    
        
        $selecting->more_details("WHERE referred = ?# $refcode");
        $action = $selecting->action("username, amount, date", "referred");
        if($action != null) return $action;
        $value = $selecting->pull();
        $selecting->reset();
        
        $selecting->more_details("WHERE referred = ? AND verify = ?# $refcode# $zero");
        $value1 = $selecting->action("username, email, verify", "user");
        if($action != null) return $action;
        $value1 = $selecting->pull();
        $selecting->reset();

        $selecting->more_details("WHERE user = ?# $userId");
        $action= $selecting->action('amount, package, date', 'investments');
        if($action != null) return $action;
        $value = $selecting->pull();
        $selecting->reset();
    
        $data = $value[0];

        $selecting->more_details("WHERE email = ?# $email");
        $action = $selecting->action('usd, mode, status, date', 'btc');
        if($action != null) return $action;
        $selecting->reset();
        $value = $selecting->pull();
    
        $deposits = $value[0];

        $selecting->more_details("WHERE email = ?# $email");
        $value = $selecting->action('moni, mode, date, status', 'wbtc');
        if($action != null) return $action;
        $selecting->reset();
        $value = $selecting->pull();

        $withdrawals = $value[0];

        $selecting->more_details("");
        $action = $selecting->action("pname, increase, bonus, duration, froms, tos", "package1");
        if($action != null) return $action;
        $selecting->reset();
        $packages = $selecting->pull();

    endif;

?>